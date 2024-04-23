<?php
/**
 * The Partner Settings
 */

namespace Extendify;

/**
 * Controller for handling partner settings
 */
class PartnerData
{

    /**
     * The partner id
     *
     * @var string
     */
    public static $id = 'no-partner';

    /**
     * The partner logo
     *
     * @var string
     */
    public static $logo = '';

    /**
     * The partner display name
     *
     * @var string
     */
    public static $name = '';

    /**
     * The partner colors
     *
     * @var string
     */
    public static $colors = [];

    /**
     * The partner configuration.
     *
     * @var array
     */
    protected static $config = [
        'disableRecommendations' => false,
        'showDomainBanner' => false,
        'showDomainTask' => false,
        'showSecondaryDomainBanner' => false,
        'showSecondaryDomainTask' => false,
        'domainTLDs' => ['com', 'net'],
        'stagingSites' => ['wordpress.test'],
        'domainSearchURL' => '',
    ];

    // phpcs:disable Generic.Metrics.CyclomaticComplexity.TooHigh
    /**
     * Set up and collect partner data
     *
     * @return void
     */
    public function __construct()
    {
        if (isset($GLOBALS['extendify_sdk_partner']) && $GLOBALS['extendify_sdk_partner']) {
            self::$id = $GLOBALS['extendify_sdk_partner'];
        }

        // Always use the partner ID if set as a constant.
        if (defined('EXTENDIFY_PARTNER_ID')) {
            self::$id = constant('EXTENDIFY_PARTNER_ID');
        }

        // If the plugin has no partner, don't fetch data.
        if (self::$id === 'no-partner') {
            return;
        }

        if (!current_user_can(Config::$requiredCapability)) {
            return;
        }

        $data = self::getPartnerData();
        self::$config['disableRecommendations'] = ($data['disableRecommendations'] ?? self::$config['disableRecommendations']);
        self::$config['showDomainBanner'] = ($data['showDomainBanner'] ?? self::$config['showDomainBanner']);
        self::$config['showDomainTask'] = ($data['showDomainTask'] ?? self::$config['showDomainTask']);
        self::$config['showSecondaryDomainTask'] = ($data['showSecondaryDomainTask'] ?? self::$config['showSecondaryDomainTask']);
        self::$config['showSecondaryDomainBanner'] = ($data['showSecondaryDomainBanner'] ?? self::$config['showSecondaryDomainBanner']);
        self::$config['domainTLDs'] = implode(',', array_map(function ($item) {
            return trim(str_replace('.', '', $item));
        }, ($data['domainTLDs'] ?? self::$config['domainTLDs'])));
        self::$config['stagingSites'] = array_map('trim', ($data['stagingSites'] ?? self::$config['stagingSites']));
        self::$config['domainSearchURL'] = ($data['domainSearchURL'] ?? self::$config['domainSearchURL']);
        self::$logo = isset($data['logo'][0]['thumbnails']['large']['url']) ? $data['logo'][0]['thumbnails']['large']['url'] : self::$logo;
        self::$name = ($data['Name'] ?? self::$name);
        self::$colors = [
            'backgroundColor' => ($data['backgroundColor'] ?? null),
            'foregroundColor' => ($data['foregroundColor'] ?? null),
            'secondaryColor' => ($data['secondaryColor'] ?? ($data['backgroundColor'] ?? null)),
            'secondaryColorText' => '#ffffff',
        ];
    }

    /**
     * Retrieve partner data from a transient or from the API.
     *
     * @return array
     */
    public static function getPartnerData()
    {
        // If the transient is already set, don't fetch again.
        $transientData = get_transient('extendify_partner_data');
        // Check the secondaryColor as the Launch Command does not add this in some versions.
        if ($transientData !== false && isset($transientData['secondaryColor'])) {
            return get_option('extendify_partner_data', []);
        }

        $response = wp_remote_get(
            add_query_arg(
                ['partner' => self::$id],
                'https://dashboard.extendify.com/api/onboarding/partner-data/'
            ),
            ['headers' => ['Accept' => 'application/json']]
        );

        if (is_wp_error($response)) {
            // If the request fails, try again in 24 hours.
            set_transient('extendify_partner_data', [], DAY_IN_SECONDS);
            return get_option('extendify_partner_data', []);
        }

        $result = json_decode(wp_remote_retrieve_body($response), true);

        if (!array_key_exists('data', $result)) {
            // If the request didn't have the data key, try again in 24 hours.
            set_transient('extendify_partner_data', [], DAY_IN_SECONDS);
            return get_option('extendify_partner_data', []);
        }

        // Transient is used to mark the time, but the data is put into an option,
        // so that in case of network issues, we can still return old data.
        set_transient('extendify_partner_data', $result['data'], (2 * DAY_IN_SECONDS));
        update_option('extendify_partner_data', $result['data']);
        return $result['data'];
    }

    /**
     * Return colors mapped as css variables
     *
     * @return array
     */
    public static function cssVariableMapping()
    {
        $mapping = [
            'backgroundColor' => '--ext-banner-main',
            'foregroundColor' => '--ext-banner-text',
            'secondaryColor' => '--ext-design-main',
            'secondaryColorText' => '--ext-design-text',
        ];

        $cssVariables = [];
        $adminTheme = \get_user_option('admin_color', get_current_user_id());
        if (isset($GLOBALS['_wp_admin_css_colors'][$adminTheme])) {
            $theme = $GLOBALS['_wp_admin_css_colors'][$adminTheme];
            if (in_array($adminTheme, ['modern', 'blue'], true)) {
                $cssVariables['--wp-admin-theme-main'] = $theme->colors[1];
                $cssVariables['--wp-admin-theme-accent'] = $theme->colors[2];
            } else {
                $cssVariables['--wp-admin-theme-bg'] = $theme->colors[0];
                $cssVariables['--wp-admin-theme-main'] = $theme->colors[2];
                $cssVariables['--wp-admin-theme-accent'] = $theme->colors[3];
            }
        }

        foreach ($mapping as $color => $variable) {
            if (isset(self::$colors[$color])) {
                $cssVariables[$variable] = self::$colors[$color];
            }
        }

        return $cssVariables;
    }

    /**
     * Return the value of the setting.
     *
     * @param string $settingKey - The key of the config.
     * @return mixed
     */
    public static function setting($settingKey)
    {
        return self::$config[$settingKey];
    }
}
