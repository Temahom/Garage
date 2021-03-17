<html>
    <head>
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       
        
    <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </head>
<style>
    /*LIfe's not complete without art. 

				      |\"-,_--_._..---.._,"/|
                  l|"-.  _.v._   (" |
                  [l /.'_ \; _~"-.`-t
                  Y " _(o} _{o)._ ^.|
                  j  T  ,-<v>-.  T  ]
                  \  l ( /-^-\ ) !  !
                   \. \.  "~"  ./  /c-..,__
                     ^r- .._ .- .-"  `- .  ~"--.
                      > \.                      \
                      T   ^.                     \
                      M  .  ">            .       Y 
         ,.__.--._   _R   \ ~   .         ;       |
        (    ~"-._~"^._\   ^.    ^._      I     . l
         "-._ ___ ~"-,_7    .Z-._   7"   Y      ;  \        _
            /"   "~-(r r  _/_--._~-/    /      /,.--^-._   / Y
            "-._    '"~~~>-._~]>--^---./____,.^~        ^.^  !
                ~--._    '   Y---.                        \./
                     ~~--._  l_   )                        \
                           ~-._~~~---._,____..---           \
                               ~----"~       \
                                              \	
*/


@import url(https://fonts.googleapis.com/css?family=Oswald);

body {
	margin: 0;
	background:#FFD966;
	text-align: center;
}
	
#menu-wrapper {
		position: relative;
		display: block;
		z-index: 2;
		height: 60px;
		background-image: -webkit-gradient(linear, left top, left bottom, from(#535557), to(#333532));
		background-image: -webkit-linear-gradient(top, #535557, #333532);
		background-image:    -moz-linear-gradient(top, #535557, #333532); 
		background-image:     -ms-linear-gradient(top, #535557, #333532); 
		background-image:      -o-linear-gradient(top, #535557, #333532); 
		background-image:         linear-gradient(to bottom, #535557, #333532);
		font-family: 'Oswald', sans-serif;
		font-size: 15px;
		color: #fff;
		text-align: center;
}
	
.menu {
		display: block;
		margin: 0 auto;
		padding: 0;
		width: 870px;
		text-align: left;
		list-style-type: none;
}
		
.menu li {
		display: inline-block;
		padding: 16px 10px 25px 10px;
		cursor: pointer;
		-webkit-transition: 0.3s ease-in-out;
		-moz-transition: 0.3s ease-in-out;
		-ms-transition: 0.3s ease-in-out;
		-o-transition: 0.3s ease-in-out;
		transition: 0.3s ease-in-out;
}
				
		
.menu a, .menu a:visited {
		color: #fff;
		font-weight:bold;
		text-decoration: none;
}
	
#submenu-wrapper {
		position: absolute;
		right: 0;
		left: 0;
		display: block;
		z-index: 1;
		width: 850px;
		height: 136px;
		margin: -11px auto 0;
		padding: 10px 10px;
		background: rgba(33,37,37,0.9);
		font-family: 'Oswald', sans-serif;
		font-size: 13px;
		-webkit-border-bottom-right-radius: 10px;
		-webkit-border-bottom-left-radius: 10px;
		-moz-border-radius-bottomright: 10px;
		-moz-border-radius-bottomleft: 10px;
		border-bottom-right-radius: 10px;
		border-bottom-left-radius: 10px;
		box-shadow: 0px 2px 7px rgba(0,0,0,0.5);
		overflow: hidden;
}	
	
.submenu {
		display: block;
		margin: 1em 0 2em;
		padding: 0;
		list-style-type: none;
}
		
.submenu li {
		display: inline-block;
		width: 210px;
		vertical-align: top;
		margin-bottom:.5em;
		text-align: center;
}
				
.submenu li img {
		display: block;
		margin: 0 auto 1em;
		width: 200px;
		border-radius: 5px;
		border: 0;
}
				
.submenu li a, .submenu li a:visited {
		color: #fff;
		text-decoration: none;
}

#title {
		display: block;
		margin-top: 4em;
		font-family: 'Oswald', sans-serif;
		font-size: 45px;
		color: #fff;
}
		
#title a, #title a:visited {
			font-size: 20px;
			text-decoration: none;
			color: #fff;
}
	
</style>

<script>
    https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js
    $(document).ready(function() {
  $('#submenu-wrapper').hide();
	/* Assign Variables*/
	menu				= $('.menu li');
	submenuWrapper	= $('#submenu-wrapper'); 
	submenu			= submenuWrapper.children('ul');
	firstSubmenu 	= submenu.eq(0);
	
	/* menu on hover */
	menu.hover(
		function() {
			$('#submenu-wrapper').show();
			moveTo = $(this).index() * 11;
			showsubmenu(submenuWrapper);
			firstSubmenu.stop().animate({'marginTop' : '-'+moveTo+'em' });
		},
		
		function() { hidesubmenu(submenuWrapper); });
	
	/* sub menu hover */
	submenuWrapper.hover(
		function() { showsubmenu($(this)); },
		function() { hidesubmenu($(this));
	});
	
	/*Focus effect on selected child list item */
	submenu
		.children('li')
		.hover(	function() { $(this).siblings().stop().animate({'opacity':'0.5'}); }, 
					function() { $(this).siblings().stop().animate({'opacity':'1'}); });
	
	/* Focus effect on selected parent list item */
	submenu
		.hover(	function() { menu.eq($(this).index()).addClass('selected')  },
					function() { menu.eq($(this).index()).removeClass('selected') });
	
	/* Function to show sub menu */
	function showsubmenu(item) {
		if(!item.hasClass('show'))
			item.addClass('show').stop().animate({'marginTop' : '0'});
	}
	
	/* Function to hide sub menu */
	function hidesubmenu(item) {
		item.removeClass('show').stop().animate({'marginTop' : '-12em'});
	}
	
});
</script>
<body>
	<div id="menu-wrapper">
		<ul class="menu">
			<li> <a href="#">Something</a> </li>
			<li> <a href="#">Something Else</a> </li>
			<li> <a href="#">Another Something</a> </li>
			<li> <a href="#">Another Something Else</a> </li>
		</ul>
	</div>
	<div id="submenu-wrapper">
		<ul class="submenu">
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					Interesting Image Link Info
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					Interesting Image Link Info
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					Interesting Image Link Info
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					Some More Interesting Image Link Info
				</a>
			</li>
		</ul>
		<ul class="submenu">
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					Some Image Link Info
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					More Image Link Info
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110"/>
					More...More...And...More
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110"/>
					Something Special About This 
				</a>
			</li>
		</ul>
		<ul class="submenu">
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					I Love Code!
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110"/>
					This Is Why I Love Code...
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					And I Love JavasScript! 
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					And I Can't Forget CSS3!
				</a>
			</li>
		</ul>
		<ul class="submenu">
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					A Million Reasons To Love The Web...
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					Reasons To Love Making The Web!
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110" />
					This Is Menu Awesomeness!
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://placehold.it/250x110"/>
					The Web Is Full Of Inspiration!
				</a>
			</li>
		</ul>
	</div>


</body>
</html>