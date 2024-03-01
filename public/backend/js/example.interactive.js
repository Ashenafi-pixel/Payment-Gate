



    $(document).ready(function(){
        //  domoGuide();
    })

function domoGuide() {
	var guide = $.guide({

		actions: [
			{
				element: $('#dashboard'),
				content: '<p>Welcome, click on the screen at any position to enter the next step</p>',
				offsetX: 0,
				offsetY: 60
			},
			{
				element: $('#merchant-link'),
				content: '<p>How to using...</p>',
				offsetX: 0,
				offsetY: 60
			},
			{
				element: $('#chart-main'),
				content: '<p>......</p>',
				offsetX: 0,
				offsetY: -50
			}
		]
	});
}
