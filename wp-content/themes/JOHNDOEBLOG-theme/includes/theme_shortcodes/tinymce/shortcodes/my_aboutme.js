frameworkShortcodeAtts={
	attributes:[
			{
				label:"How many about me posts to show?",
				id:"num",
				help:"This is how many about me posts will be displayed."
			},
			{
				label:"Effect",
				id:"effect",
				controlType:"select-control", 
				selectValues:['slide', 'fade'],
				defaultValue: 'slide', 
				defaultText: 'slide',
				help:"Choose the transition effect."
			},
			{
				label:"Do you want to enable smooth height for slides?",
				id:"smooth",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Enable or disable smooth height."
			},
			{
				label:"Custom class",
				id:"custom_class",
				help:"Use this field if you want to use a custom class."
			}
	],
	defaultContent:"",
	shortcode:"aboutme"
};