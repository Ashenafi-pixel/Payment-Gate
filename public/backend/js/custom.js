new PureCounter();
function switchScreen() {
    var screen = document.getElementById('screen')
    var doc = document.documentElement;
    let url = window.location.origin;
    var fullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
        (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
        (document.msFullscreenElement && document.msFullscreenElement !== null) ||
        (document.webkitFullscreenElement && document.webkitFullscreenElement !== null);
    if (!fullScreen) {
        screen.src = url + "/images/icons/exit-fullscreen.svg"
        if (doc.requestFullscreen) {
            doc.requestFullscreen();
        } else if (doc.mozRequestFullScreen) {
            doc.mozRequestFullScreen();
        } else if (doc.webkitRequestFullScreen) {
            doc.webkitRequestFullScreen();
        } else if (doc.msRequestFullscreen) {
            doc.msRequestFullscreen();
        }
    } else {
        screen.src = url + "/images/icons/fullscreen.svg"
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}
function switchView(){
 var view= document.getElementById('view-symbol');
 var table= document.querySelector(".tables");
 var grid= document.querySelector(".grids");

 if(view.innerText=='grid_view'){
    view.innerText=  "view_agenda";
    table.style.display = "none"
    grid.style.display = "block"
 }
 else if(view.innerText=='view_agenda'){
    view.innerText=  "grid_view";
    table.style.display = "block"
    grid.style.display = "none"
 }
}
$("#select").select2({
    tags: true,
    dropdownParent: $('#selec2-parent'),
    theme: "bootstrap-5",
 });
$(document).ready(function () {

    $('.img-loader').show();
    setTimeout(function () {
        $('.img-loader').hide();
        $('.d-box .d-heading').css('display', 'block');
    }, 1000);

});

$(window).on('load',function () {
        const lightTheme = 'light';
        const darkTheme = 'dark';
        const htmlTheme = 'data-theme';
        const collapsed = 'collapsed';
        const boxed = 'boxed';
        const htmlSidebar = 'data-sidebar';
        const sidebarColor = 'sidebar-color'
        const defaultColor = 'default'
        const darkColor = 'dark';
        const bg = 'light-grey'
        const darkThemeColor = 'dark-theme'
        const themeYellow = 'theme-yellow'
        const themeOrange = 'theme-orange'
        const themeGreen = 'theme-green'

        if (localStorage.getItem(htmlTheme) === 'undefined' || localStorage.getItem(htmlTheme) === null)
            setThemeAndlocal(lightTheme);
        if (localStorage.getItem(htmlTheme) == darkTheme) {
            $('html').attr(htmlTheme, darkTheme);
            $('#dark-outlined').prop('checked', true);
        } else if (localStorage.getItem(htmlTheme) == lightTheme) {
            $('#light-outlined').prop('checked', true);
            $('html').attr(htmlTheme, lightTheme);
        }

        if (localStorage.getItem(htmlSidebar) === 'undefined' || localStorage.getItem(htmlSidebar) === null)
        setSidebarAndlocal(boxed);
        if (localStorage.getItem(htmlSidebar) == boxed) {
            $('html').attr(htmlSidebar, boxed);
            $('#s-boxed').prop('checked', true);
        } else if (localStorage.getItem(htmlSidebar) == collapsed) {
            $('#s-collapsed').prop('checked', true);
            $('html').attr(htmlSidebar, collapsed);
        }

        if (localStorage.getItem(sidebarColor) === 'undefined' || localStorage.getItem(sidebarColor) === null)
        setSidebarColorAndlocal(defaultColor);
        if (localStorage.getItem(sidebarColor) == darkColor) {
            $('html').attr(sidebarColor, darkColor);
            $('#dark-color').prop('checked', true);
        } else if (localStorage.getItem(sidebarColor) == defaultColor) {
            $('#default').prop('checked', true);
            $('html').attr(sidebarColor, defaultColor);
        }
        else if (localStorage.getItem(sidebarColor) == bg) {
            $('#light-grey').prop('checked', true);
            $('html').attr(sidebarColor, bg);
        } else if (localStorage.getItem(sidebarColor) == darkThemeColor) {
            $('#dark-theme').prop('checked', true);
            $('html').attr(sidebarColor, darkThemeColor);
        } else if (localStorage.getItem(sidebarColor) == themeYellow) {
            $('#theme-yellow').prop('checked', true);
            $('html').attr(sidebarColor, themeYellow);
        } else if (localStorage.getItem(sidebarColor) == themeOrange) {
            $('#theme-orange').prop('checked', true);
            $('html').attr(sidebarColor, themeOrange);
        } else if (localStorage.getItem(sidebarColor) == themeGreen) {
            $('#theme-green').prop('checked', true);
            $('html').attr(sidebarColor, themeGreen);
        } else{
            $('#default').prop('checked', true);
            $('html').attr(sidebarColor, defaultColor);
        }


        $(".theme-radio").change(function () {
            var val = $(".theme-radio:checked").val();
            resetTheme(val);
        })
        $(".sidebar-radio").change(function () {
            var val = $(".sidebar-radio:checked").val();
            resetSidebar(val);
        })

        $(".colors-radio").change(function () {
            var val = $(".colors-radio:checked").val();
            resetSidebarColor(val);
        })

        function resetTheme(e) {
            if (e === lightTheme)
                setThemeAndlocal(lightTheme);
            else
                setThemeAndlocal(darkTheme);
        }
        function setThemeAndlocal(theme) {
            if (theme === lightTheme)
                $('#light-outlined').prop('checked', true);
            else
                $('#dark-outlined').prop('checked', true);
            $('html').attr(htmlTheme, theme);
            localStorage.setItem(htmlTheme, theme);
        }
        function resetSidebar(e) {
            if (e === collapsed)
            setSidebarAndlocal(collapsed);
            else
            setSidebarAndlocal(boxed);
        }
        function setSidebarAndlocal(sidebar) {
            if (sidebar === collapsed)
                $('#s-collapsed').prop('checked', true);
            else
            $('#s-boxed').prop('checked', true);
            $('html').attr(htmlSidebar, sidebar);
            localStorage.setItem(htmlSidebar, sidebar);
        }
        function resetSidebarColor(e) {
            switch (e) {
                case darkColor:
                    setSidebarColorAndlocal(darkColor);
                  break;
                case darkThemeColor:
                    setSidebarColorAndlocal(darkThemeColor);
                  break;
                case bg:
                    setSidebarColorAndlocal(bg);
                  break;
                case themeYellow:
                    setSidebarColorAndlocal(themeYellow);
                  break;
                case themeOrange:
                    setSidebarColorAndlocal(themeOrange);
                  break;
                case themeGreen:
                    setSidebarColorAndlocal(themeGreen);
                  break;
                 case defaultColor:
                    setSidebarColorAndlocal(defaultColor);
                  break;
                default:
                    setSidebarColorAndlocal(defaultColor);
              }
        }
        function setSidebarColorAndlocal(color) {
            switch (color){
            case darkColor:
                $('#dark-color').prop('checked', true);
                $('html').attr(sidebarColor, color);
                localStorage.setItem(sidebarColor, color);
                break;
            case defaultColor:
                $('#default').prop('checked', true);
                $('html').attr(sidebarColor, color);
                localStorage.setItem(sidebarColor, color);
                break;
            case bg:
                $('#light-grey').prop('checked', true);
                $('html').attr(sidebarColor, color);
                localStorage.setItem(sidebarColor, color);
                break;
            case darkThemeColor:
                $('#dark-theme').prop('checked', true);
                $('html').attr(sidebarColor, color);
                localStorage.setItem(sidebarColor, color);
                break;
            case themeYellow:
                $('#theme-yellow').prop('checked', true);
                $('html').attr(sidebarColor, color);
                localStorage.setItem(sidebarColor, color);
                break;
            case themeOrange:
                $('#theme-orange').prop('checked', true);
                $('html').attr(sidebarColor, color);
                localStorage.setItem(sidebarColor, color);
                break;
            case themeGreen:
                $('#theme-green').prop('checked', true);
                $('html').attr(sidebarColor, color);
                localStorage.setItem(sidebarColor, color);
                break;
            default:
                $('#default').prop('checked', true);
                $('html').attr(sidebarColor, color);
                localStorage.setItem(sidebarColor, color);
            }

        }
    });
//File name append
$(".custom-file-input").on("change", function() {
    let fileName = $(this).val().split("\\").pop();
    $('.file-name').text(fileName);
});
