frameworkShortcodeAtts={
	attributes:[
			{
				label:"Title",
				id:"title",
				help:"Title for your carousel."
			},
			{
				label:"How many posts to show?",
				id:"num",
				help:"This is how many recent posts will be displayed."
			},
			{
				label:"Type of posts",
				id:"type",
				controlType:"select-control", 
				selectValues:['blog'],
				defaultValue: 'post', 
				defaultText: 'blog',
				help:"Choose the type of posts."
			},
			{
				label:"Do you want to show the featured image?",
				id:"thumb",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable featured image."
			},
			{
				label:"Do you want to show post title?",
				id:"istitle",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable post title."
			},
			{
				label:"Thumb width",
				id:"thumb_width",
				help:"Set width of thumb."
			},
			{
				label:"Thumb height",
				id:"thumb_height",
				help:"Set height of thumb."
			},
			{
				label:"Link Text for post",
				id:"more_text_single",
				help:"Link Text for post."
			},
			{
				label:"Which category to pull from? (for Blog posts)",
				id:"category",
				help:"Enter the slug of the category you'd like to pull posts from. Leave blank if you'd like to pull from all categories."
			},
			{
				label:"Which category to pull from? (for Custom posts)",
				id:"custom_category",
				help:"Enter the slug of the category you'd like to pull posts from. Leave blank if you'd like to pull from all categories."
			},
			{
				label:"The number of characters in the excerpt",
				id:"excerpt_count",
				help:"How many characters are displayed in the excerpt?"
			},
			{
				label:"Display post date?",
				id:"date",
				controlType:"select-control", 
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:"Enable or disable post date."
			},
			{
				label:"Display post author?",
				id:"author",
				controlType:"select-control", 
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:"Enable or disable post author."
			},
			{
				label:"Max Items",
				id:"max_items",
				help:"Maximum number of visible items."
			},
			{
				label:"Do you want to show navigation?",
				id:"navigation",
				controlType:"select-control", 
				selectValues:['yes', 'no'],
				defaultValue: 'yes', 
				defaultText: 'yes',
				help:"Enable or disable navigation."
			},
			{
				label:"Auto scrolling",
				id:"scrolling",
				controlType:"select-control", 
			selectValues:['yes', 'no'],
				defaultValue: 'no', 
				defaultText: 'no',
				help:"Enable or disable auto scrolling."
			},
			{
				label:"Custom class",
				id:"custom_class",
				help:"Use this field if you want to use a custom class."
			}
	],
	defaultContent:"",
	shortcode:"carousel"
};