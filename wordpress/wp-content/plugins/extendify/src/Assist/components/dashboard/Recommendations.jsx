import { __ } from '@wordpress/i18n';
import { RecommendationCard } from '@assist/components/dashboard/RecommendationCard';
import { useRecommendations } from '@assist/hooks/useRecommendations';

export const Recommendations = () => {
	const recommendations = useRecommendations();

	if (!recommendations?.length) return;

	return (
		<div
			id="assist-recommendations-module"
			className="w-full p-5 lg:p-8 border border-gray-300 text-base bg-white rounded h-full">
			<h2 className="font-semibold text-lg mt-0 mb-4">
				{__('Website Tools & Plugins', 'extendify-local')}
			</h2>
			<div className="grid md:grid-cols-3 md:gap-3 gap-y-3">
				{recommendations.map((recommendation) => (
					<RecommendationCard
						key={recommendation.slug}
						recommendation={recommendation}
					/>
				))}
			</div>
		</div>
	);
};
