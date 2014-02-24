frameworkShortcodeAtts={
	attributes:[
			{
				label:"Icon name",
				id:"icons",
				help:"Enter the name of the icon. Example: icon-shopping-cart. Complete list of the icons you will find at http://fortawesome.github.io/Font-Awesome/icons/."
			},
			{
				label:"Align",
				id:"align",
				controlType:"select-control",
				selectValues:['left', 'right', 'center', 'none'],
				defaultValue: 'left', 
				defaultText: 'left',
				help:"Choose icon's align."
			},
			{
				label:"Size",
				id:"size",
				controlType:"select-control",
				selectValues:['icon-1x', 'icon-2x', 'icon-3x', 'icon-4x', 'icon-5x', 'icon-6x', 'icon-7x', 'icon-8x', 'icon-9x'],
				defaultValue: 'icon-5x', 
				defaultText: 'icon-5x',
				help:"Choose icon's size."
			},
			{
				label:"Icon color",
				id:"color",
				help:"Enter icons color"
			}
	],
	defaultContent:"",
	shortcode:"icon"
};