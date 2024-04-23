import { __ } from '@wordpress/i18n';

export default {
	slug: 'site-assistant-tour',
	title: __('Take a welcome tour', 'extendify-local'),
	description: __(
		'Learn how to access key areas of your WordPress site.',
		'extendify-local',
	),
	buttonLabels: {
		completed: __('Restart', 'extendify-local'),
		notCompleted: __('Start', 'extendify-local'),
	},
	type: 'tour',
	dependencies: { goals: [], plugins: [] },
	show: ({ plugins, goals, activePlugins, userGoals }) => {
		if (!plugins.length && !goals.length) return true;

		return activePlugins
			.concat(userGoals)
			.some((item) => plugins.concat(goals).includes(item));
	},
	backgroundImage: `${window.extAssistData.asset_path}/welcome-tour.png`,
};
