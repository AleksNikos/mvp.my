function tab_login(e,s){var n,o,t;for(o=document.getElementsByClassName("tabcontent"),n=0;n<o.length;n++)o[n].style.display="none";for(t=document.getElementsByClassName("tablinks"),n=0;n<t.length;n++)t[n].className=t[n].className.replace(" active","");document.getElementById(s).style.display="block",e.currentTarget.className+=" active"}$(document).ready(function(){$(".learn-more").on("click","a",function(e){fullpage_api.moveSectionDown()})}),$(window).scroll(function(){var e=$(this).scrollTop();e>20?$(".topbar-wrap").addClass("active"):$(".topbar-wrap").removeClass("active")}),$(".login-btn").click(function(){$("#login-popup").css("display","block"),$(".create-btn-tab").removeClass("active"),$(".login-btn-tab").addClass("active"),$("#create-popup").css("display","none"),$("#reset").css("display","none"),$(".tab").css("display","block")}),$(".sign_up-btn").click(function(){$("#create-popup").css("display","block"),$(".login-btn-tab").removeClass("active"),$(".create-btn-tab").addClass("active"),$("#login-popup").css("display","none"),$("#reset").css("display","none"),$(".tab").css("display","block")}),$(".cant_login").click(function(){$("#reset").css("display","block"),$("#create-popup").css("display","none"),$("#login-popup").css("display","none"),$(".tab").css("display","none")}),$("#reset > .back").click(function(){$("#reset").css("display","none"),$("#login-popup").css("display","block"),$(".tab").css("display","block")}),$(".fd_1").on("click touchend",function(){$(".demo_fd").addClass("d-none"),$(".fd1").removeClass("d-none")}),$(".fd_2").on("click touchend",function(){$(".demo_fd").addClass("d-none"),$(".fd2").removeClass("d-none")}),$(".fd_3").on("click touchend",function(){$(".demo_fd").addClass("d-none"),$(".fd3").removeClass("d-none")}),$(".fd_4").on("click touchend",function(){$(".demo_fd").addClass("d-none"),$(".fd4").removeClass("d-none")}),$(".er_1").on("click touchend",function(){$(".demo_er").addClass("d-none"),$(".er1").removeClass("d-none")}),$(".er_2").on("click touchend",function(){$(".demo_er").addClass("d-none"),$(".er2").removeClass("d-none")}),$(".er_3").on("click touchend",function(){$(".demo_er").addClass("d-none"),$(".er3").removeClass("d-none")}),$(".er_4").on("click touchend",function(){$(".demo_er").addClass("d-none"),$(".er4").removeClass("d-none")}),$(".back").on("click touchend",function(){$(".demo_fd").removeClass("d-none"),$(".demo_er").removeClass("d-none"),$(".fd1").addClass("d-none"),$(".fd2").addClass("d-none"),$(".fd3").addClass("d-none"),$(".fd4").addClass("d-none"),$(".er1").addClass("d-none"),$(".er2").addClass("d-none"),$(".er3").addClass("d-none"),$(".er4").addClass("d-none")}),$(".menu").on("touch click",function(){$("#menu").toggleClass("active_menu"),$(".topnav").toggleClass("active")}),jQuery(window).scroll(function(){var e=$(".link");e.each(function(e,s){if($(window).width()>560)var n=$(s).offset().top-100,o=n+$(s).height(),t=$(window).scrollTop()+100,a=$(s).attr("id");else var n=$(s).offset().top,o=n+$(s).height(),t=$(window).scrollTop(),a=$(s).attr("id");t>n&&t<o&&($(".vertical-nav > ul > li.active").removeClass("active"),$('a[href="#'+a+'"]').parent("li").addClass("active"))})}),$(document).ready(function(){$("#docs").on("click","a",function(e){e.preventDefault();var s=$(this).attr("href"),n=$(s).offset().top-100;$("body,html").animate({scrollTop:n},800)})}),new fullpage("#fullpage",{licenseKey:"F4D71089-214F4315-958D1E92-109DD6D4",recordHistory:!1,sectionSelector:"section",responsiveHeight:"600",responsiveWidth:"560",normalScrollElements:".fancybox-container",fitToSection:!0,dragAndMove:!0,scrollOverflow:!1}),new fullpage("#docs",{licenseKey:"F4D71089-214F4315-958D1E92-109DD6D4",recordHistory:!1,sectionSelector:"section",responsiveHeight:"600",responsiveWidth:"560",normalScrollElements:".fancybox-container",fitToSection:!0,dragAndMove:!0,scrollOverflow:!1}),$("[data-fancybox]").fancybox({afterLoad:function(e,s){fullpage_api.setAllowScrolling(!1)},afterClose:function(e,s){fullpage_api.setAllowScrolling(!0)}}),$(function(){$(".hide-show").show(),$(".hide-show span").addClass("show"),$(".hide-show span").click(function(){$(this).hasClass("show")?($(this).text("Hide"),$(this).parent().siblings(".password").attr("type","text"),$(this).removeClass("show")):($(this).text("Show"),$(this).parent().siblings(".password").attr("type","password"),$(this).addClass("show"))}),$("button.login").on("click",function(){$(".hide-show span").text("Show").addClass("show"),$(".hide-show").parent().find(".password").attr("type","password")})}),$('input[type="text"], input[type="password"], input[type="email"]').focus(function(){$(this).siblings("span").css("display","none"),$(this).css("padding","15px"),$(this).siblings(".hide-show").css("top","15px"),$(this).parent(":before").css("top","20px")}),$('input[type="text"], input[type="password"], input[type="email"]').blur(function(){$(this).val()?($(this).siblings("span").css("display","none"),$(this).css("padding","15px"),$(this).siblings(".hide-show").css("top","15px"),$(this).parent(":before").css("top","20px")):($(this).siblings("span").css("display","block"),$(this).css("padding","0 0 10px 10px"),$(this).siblings(".hide-show").css("top","24px"))}),$(".info").text("i"),$(".inp-wr").hasClass("error")?$(".error").children(".info").text("!"):$(".error").children(".info").text("i");
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImhvbWUuanMiXSwibmFtZXMiOlsidGFiX2xvZ2luIiwiZXZ0IiwidGFiIiwiaSIsInRhYmNvbnRlbnQiLCJ0YWJsaW5rcyIsImRvY3VtZW50IiwiZ2V0RWxlbWVudHNCeUNsYXNzTmFtZSIsImxlbmd0aCIsInN0eWxlIiwiZGlzcGxheSIsImNsYXNzTmFtZSIsInJlcGxhY2UiLCJnZXRFbGVtZW50QnlJZCIsImN1cnJlbnRUYXJnZXQiLCIkIiwicmVhZHkiLCJvbiIsImV2ZW50IiwiZnVsbHBhZ2VfYXBpIiwibW92ZVNlY3Rpb25Eb3duIiwid2luZG93Iiwic2Nyb2xsIiwid1Njcm9sbCIsInRoaXMiLCJzY3JvbGxUb3AiLCJhZGRDbGFzcyIsInJlbW92ZUNsYXNzIiwiY2xpY2siLCJjc3MiLCJ0b2dnbGVDbGFzcyIsImpRdWVyeSIsIiRzZWN0aW9ucyIsImVhY2giLCJlbCIsIndpZHRoIiwidG9wIiwib2Zmc2V0IiwiYm90dG9tIiwiaGVpZ2h0IiwiaWQiLCJhdHRyIiwicGFyZW50IiwicHJldmVudERlZmF1bHQiLCJhbmltYXRlIiwiZnVsbHBhZ2UiLCJsaWNlbnNlS2V5IiwicmVjb3JkSGlzdG9yeSIsInNlY3Rpb25TZWxlY3RvciIsInJlc3BvbnNpdmVIZWlnaHQiLCJyZXNwb25zaXZlV2lkdGgiLCJub3JtYWxTY3JvbGxFbGVtZW50cyIsImZpdFRvU2VjdGlvbiIsImRyYWdBbmRNb3ZlIiwic2Nyb2xsT3ZlcmZsb3ciLCJmYW5jeWJveCIsImFmdGVyTG9hZCIsImluc3RhbmNlIiwic2xpZGUiLCJzZXRBbGxvd1Njcm9sbGluZyIsImFmdGVyQ2xvc2UiLCJzaG93IiwiaGFzQ2xhc3MiLCJ0ZXh0Iiwic2libGluZ3MiLCJmaW5kIiwiZm9jdXMiLCJibHVyIiwidmFsIiwiY2hpbGRyZW4iXSwibWFwcGluZ3MiOiJBQWlHRSxRQUFTQSxXQUFVQyxFQUFLQyxHQUN0QixHQUFJQyxHQUFHQyxFQUFZQyxDQUVuQixLQURBRCxFQUFhRSxTQUFTQyx1QkFBdUIsY0FDeENKLEVBQUksRUFBR0EsRUFBSUMsRUFBV0ksT0FBUUwsSUFDakNDLEVBQVdELEdBQUdNLE1BQU1DLFFBQVUsTUFHaEMsS0FEQUwsRUFBV0MsU0FBU0MsdUJBQXVCLFlBQ3RDSixFQUFJLEVBQUdBLEVBQUlFLEVBQVNHLE9BQVFMLElBQy9CRSxFQUFTRixHQUFHUSxVQUFZTixFQUFTRixHQUFHUSxVQUFVQyxRQUFRLFVBQVcsR0FFbkVOLFVBQVNPLGVBQWVYLEdBQUtPLE1BQU1DLFFBQVUsUUFDN0NULEVBQUlhLGNBQWNILFdBQWEsVUEzR2pDSSxFQUFFVCxVQUFVVSxNQUFNLFdBQ2hCRCxFQUFFLGVBQWVFLEdBQUcsUUFBUSxJQUFLLFNBQVVDLEdBQ3pDQyxhQUFhQyxzQkFLakJMLEVBQUVNLFFBQVFDLE9BQU8sV0FDZixHQUFJQyxHQUFVUixFQUFFUyxNQUFNQyxXQUNsQkYsR0FBVSxHQUNaUixFQUFFLGdCQUFnQlcsU0FBUyxVQUczQlgsRUFBRSxnQkFBZ0JZLFlBQVksWUFLaENaLEVBQUUsY0FBY2EsTUFBTSxXQUNwQmIsRUFBRSxnQkFBZ0JjLElBQUksVUFBVSxTQUNoQ2QsRUFBRSxtQkFBbUJZLFlBQVksVUFDakNaLEVBQUUsa0JBQWtCVyxTQUFTLFVBQzdCWCxFQUFFLGlCQUFpQmMsSUFBSSxVQUFVLFFBQ2pDZCxFQUFFLFVBQVVjLElBQUksVUFBVSxRQUMxQmQsRUFBRSxRQUFRYyxJQUFJLFVBQVUsV0FHMUJkLEVBQUUsZ0JBQWdCYSxNQUFNLFdBQ3RCYixFQUFFLGlCQUFpQmMsSUFBSSxVQUFVLFNBQ2pDZCxFQUFFLGtCQUFrQlksWUFBWSxVQUNoQ1osRUFBRSxtQkFBbUJXLFNBQVMsVUFDOUJYLEVBQUUsZ0JBQWdCYyxJQUFJLFVBQVUsUUFDaENkLEVBQUUsVUFBVWMsSUFBSSxVQUFVLFFBQzFCZCxFQUFFLFFBQVFjLElBQUksVUFBVSxXQUcxQmQsRUFBRSxlQUFlYSxNQUFNLFdBQ3JCYixFQUFFLFVBQVVjLElBQUksVUFBVSxTQUMxQmQsRUFBRSxpQkFBaUJjLElBQUksVUFBVSxRQUNqQ2QsRUFBRSxnQkFBZ0JjLElBQUksVUFBVSxRQUNoQ2QsRUFBRSxRQUFRYyxJQUFJLFVBQVUsVUFHMUJkLEVBQUUsa0JBQWtCYSxNQUFNLFdBQ3hCYixFQUFFLFVBQVVjLElBQUksVUFBVSxRQUMxQmQsRUFBRSxnQkFBZ0JjLElBQUksVUFBVSxTQUNoQ2QsRUFBRSxRQUFRYyxJQUFJLFVBQVUsV0FJNUJkLEVBQUUsU0FBU0UsR0FBRyxpQkFBa0IsV0FDOUJGLEVBQUUsWUFBWVcsU0FBUyxVQUN2QlgsRUFBRSxRQUFRWSxZQUFZLFlBRXhCWixFQUFFLFNBQVNFLEdBQUcsaUJBQWtCLFdBQzlCRixFQUFFLFlBQVlXLFNBQVMsVUFDdkJYLEVBQUUsUUFBUVksWUFBWSxZQUV4QlosRUFBRSxTQUFTRSxHQUFHLGlCQUFrQixXQUM5QkYsRUFBRSxZQUFZVyxTQUFTLFVBQ3ZCWCxFQUFFLFFBQVFZLFlBQVksWUFFeEJaLEVBQUUsU0FBU0UsR0FBRyxpQkFBa0IsV0FDOUJGLEVBQUUsWUFBWVcsU0FBUyxVQUN2QlgsRUFBRSxRQUFRWSxZQUFZLFlBRXhCWixFQUFFLFNBQVNFLEdBQUcsaUJBQWtCLFdBQzlCRixFQUFFLFlBQVlXLFNBQVMsVUFDdkJYLEVBQUUsUUFBUVksWUFBWSxZQUV4QlosRUFBRSxTQUFTRSxHQUFHLGlCQUFrQixXQUM5QkYsRUFBRSxZQUFZVyxTQUFTLFVBQ3ZCWCxFQUFFLFFBQVFZLFlBQVksWUFFeEJaLEVBQUUsU0FBU0UsR0FBRyxpQkFBa0IsV0FDOUJGLEVBQUUsWUFBWVcsU0FBUyxVQUN2QlgsRUFBRSxRQUFRWSxZQUFZLFlBRXhCWixFQUFFLFNBQVNFLEdBQUcsaUJBQWtCLFdBQzlCRixFQUFFLFlBQVlXLFNBQVMsVUFDdkJYLEVBQUUsUUFBUVksWUFBWSxZQUV4QlosRUFBRSxTQUFTRSxHQUFHLGlCQUFrQixXQUM5QkYsRUFBRSxZQUFZWSxZQUFZLFVBQzFCWixFQUFFLFlBQVlZLFlBQVksVUFDMUJaLEVBQUUsUUFBUVcsU0FBUyxVQUNuQlgsRUFBRSxRQUFRVyxTQUFTLFVBQ25CWCxFQUFFLFFBQVFXLFNBQVMsVUFDbkJYLEVBQUUsUUFBUVcsU0FBUyxVQUNuQlgsRUFBRSxRQUFRVyxTQUFTLFVBQ25CWCxFQUFFLFFBQVFXLFNBQVMsVUFDbkJYLEVBQUUsUUFBUVcsU0FBUyxVQUNuQlgsRUFBRSxRQUFRVyxTQUFTLFlBbUJyQlgsRUFBRSxTQUFTRSxHQUFHLGNBQWUsV0FDM0JGLEVBQUUsU0FBU2UsWUFBWSxlQUN2QmYsRUFBRSxXQUFXZSxZQUFZLFlBSzNCQyxPQUFPVixRQUFRQyxPQUFPLFdBQ3BCLEdBQUlVLEdBQVlqQixFQUFFLFFBQ2xCaUIsR0FBVUMsS0FBSyxTQUFTOUIsRUFBRStCLEdBQ3hCLEdBQUduQixFQUFFTSxRQUFRYyxRQUFVLElBQ3JCLEdBQUlDLEdBQU9yQixFQUFFbUIsR0FBSUcsU0FBU0QsSUFBTSxJQUM1QkUsRUFBVUYsRUFBS3JCLEVBQUVtQixHQUFJSyxTQUNyQmpCLEVBQVNQLEVBQUVNLFFBQVFJLFlBQWMsSUFDakNlLEVBQUt6QixFQUFFbUIsR0FBSU8sS0FBSyxVQUVwQixJQUFJTCxHQUFPckIsRUFBRW1CLEdBQUlHLFNBQVNELElBQ3RCRSxFQUFVRixFQUFLckIsRUFBRW1CLEdBQUlLLFNBQ3JCakIsRUFBU1AsRUFBRU0sUUFBUUksWUFDbkJlLEVBQUt6QixFQUFFbUIsR0FBSU8sS0FBSyxLQUVsQm5CLEdBQVNjLEdBQU9kLEVBQVNnQixJQUMzQnZCLEVBQUUsa0NBQWtDWSxZQUFZLFVBQ2hEWixFQUFFLFlBQVl5QixFQUFHLE1BQU1FLE9BQU8sTUFBTWhCLFNBQVMsZUFLbkRYLEVBQUVULFVBQVVVLE1BQU0sV0FDaEJELEVBQUUsU0FBU0UsR0FBRyxRQUFRLElBQUssU0FBVUMsR0FDbkNBLEVBQU15QixnQkFDTixJQUFJSCxHQUFNekIsRUFBRVMsTUFBTWlCLEtBQUssUUFDdkJMLEVBQU1yQixFQUFFeUIsR0FBSUgsU0FBU0QsSUFBTSxHQUMzQnJCLEdBQUUsYUFBYTZCLFNBQVNuQixVQUFXVyxHQUFNLFNBSzdDLEdBQUlTLFVBQVMsYUFDWEMsV0FBWSxzQ0FDWkMsZUFBZSxFQUNmQyxnQkFBaUIsVUFDakJDLGlCQUFrQixNQUNsQkMsZ0JBQWlCLE1BQ2pCQyxxQkFBc0Isc0JBQ3RCQyxjQUFjLEVBQ2RDLGFBQVksRUFDWkMsZ0JBQWUsSUFFakIsR0FBSVQsVUFBUyxTQUNYQyxXQUFZLHNDQUNaQyxlQUFlLEVBQ2ZDLGdCQUFpQixVQUNqQkMsaUJBQWtCLE1BQ2xCQyxnQkFBaUIsTUFDakJDLHFCQUFzQixzQkFDdEJDLGNBQWMsRUFDZEMsYUFBWSxFQUNaQyxnQkFBZSxJQUtqQnZDLEVBQUUsbUJBQW1Cd0MsVUFDbkJDLFVBQVcsU0FBU0MsRUFBVUMsR0FDNUJ2QyxhQUFhd0MsbUJBQWtCLElBRWpDQyxXQUFZLFNBQVNILEVBQVVDLEdBQzdCdkMsYUFBYXdDLG1CQUFrQixNQUtuQzVDLEVBQUUsV0FDQUEsRUFBRSxjQUFjOEMsT0FDaEI5QyxFQUFFLG1CQUFtQlcsU0FBUyxRQUU5QlgsRUFBRSxtQkFBbUJhLE1BQU0sV0FDckJiLEVBQUVTLE1BQU1zQyxTQUFTLFNBQ25CL0MsRUFBRVMsTUFBTXVDLEtBQUssUUFDYmhELEVBQUVTLE1BQU1rQixTQUFTc0IsU0FBUyxhQUFhdkIsS0FBSyxPQUFPLFFBQ25EMUIsRUFBRVMsTUFBTUcsWUFBWSxVQUVuQlosRUFBRVMsTUFBTXVDLEtBQUssUUFDYmhELEVBQUVTLE1BQU1rQixTQUFTc0IsU0FBUyxhQUFhdkIsS0FBSyxPQUFPLFlBQ25EMUIsRUFBRVMsTUFBTUUsU0FBUyxXQUl0QlgsRUFBRSxnQkFBZ0JFLEdBQUcsUUFBUyxXQUM1QkYsRUFBRSxtQkFBbUJnRCxLQUFLLFFBQVFyQyxTQUFTLFFBQzNDWCxFQUFFLGNBQWMyQixTQUFTdUIsS0FBSyxhQUFheEIsS0FBSyxPQUFPLGdCQUszRDFCLEVBQUUsbUVBQW1FbUQsTUFBTSxXQUN6RW5ELEVBQUVTLE1BQU13QyxTQUFTLFFBQVFuQyxJQUFJLFVBQVUsUUFDdkNkLEVBQUVTLE1BQU1LLElBQUksVUFBVSxRQUN0QmQsRUFBRVMsTUFBTXdDLFNBQVMsY0FBY25DLElBQUksTUFBTSxRQUN6Q2QsRUFBRVMsTUFBTWtCLE9BQU8sV0FBV2IsSUFBSSxNQUFNLFVBRXRDZCxFQUFFLG1FQUFtRW9ELEtBQUssV0FDcEVwRCxFQUFFUyxNQUFNNEMsT0FDVnJELEVBQUVTLE1BQU13QyxTQUFTLFFBQVFuQyxJQUFJLFVBQVUsUUFDdkNkLEVBQUVTLE1BQU1LLElBQUksVUFBVSxRQUN0QmQsRUFBRVMsTUFBTXdDLFNBQVMsY0FBY25DLElBQUksTUFBTSxRQUN6Q2QsRUFBRVMsTUFBTWtCLE9BQU8sV0FBV2IsSUFBSSxNQUFNLFVBRXBDZCxFQUFFUyxNQUFNd0MsU0FBUyxRQUFRbkMsSUFBSSxVQUFVLFNBQ3ZDZCxFQUFFUyxNQUFNSyxJQUFJLFVBQVUsaUJBQ3RCZCxFQUFFUyxNQUFNd0MsU0FBUyxjQUFjbkMsSUFBSSxNQUFNLFdBSTdDZCxFQUFFLFNBQVNnRCxLQUFLLEtBQ2JoRCxFQUFFLFdBQVcrQyxTQUFTLFNBQ3ZCL0MsRUFBRSxVQUFVc0QsU0FBUyxTQUFTTixLQUFLLEtBRW5DaEQsRUFBRSxVQUFVc0QsU0FBUyxTQUFTTixLQUFLIiwiZmlsZSI6ImhvbWUuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBTbG93IHNjcm9sbCBvbiBMZWFybiBtb3JlXHJcbiAgJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKXtcclxuICAgICQoXCIubGVhcm4tbW9yZVwiKS5vbihcImNsaWNrXCIsXCJhXCIsIGZ1bmN0aW9uIChldmVudCkge1xyXG4gICAgICBmdWxscGFnZV9hcGkubW92ZVNlY3Rpb25Eb3duKCk7XHJcbiAgICB9KTtcclxuICB9KTtcclxuICBcclxuLy8gQWRkIGZpeGVkIHRvcGJhciB3aGVuIHNjcm9sbFxyXG4gICQod2luZG93KS5zY3JvbGwoZnVuY3Rpb24oKXtcclxuICAgIHZhciB3U2Nyb2xsID0gJCh0aGlzKS5zY3JvbGxUb3AoKTtcclxuICAgIGlmICh3U2Nyb2xsID4gMjApIHtcclxuICAgICAgJCgnLnRvcGJhci13cmFwJykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgfVxyXG4gICAgZWxzZSB7XHJcbiAgICAgICQoJy50b3BiYXItd3JhcCcpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgIH1cclxuICB9KTtcclxuXHJcbi8vIEdvIHRvIHRhYiBtb2RhbCAobG9naW4sIHNpZ24tdXAsIHJlc2V0KVxyXG4gICAgJChcIi5sb2dpbi1idG5cIikuY2xpY2soZnVuY3Rpb24oKXtcclxuICAgICAgJCgnI2xvZ2luLXBvcHVwJykuY3NzKCdkaXNwbGF5JywnYmxvY2snKTtcclxuICAgICAgJCgnLmNyZWF0ZS1idG4tdGFiJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAkKCcubG9naW4tYnRuLXRhYicpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgJCgnI2NyZWF0ZS1wb3B1cCcpLmNzcygnZGlzcGxheScsJ25vbmUnKTtcclxuICAgICAgJCgnI3Jlc2V0JykuY3NzKCdkaXNwbGF5Jywnbm9uZScpO1xyXG4gICAgICAkKCcudGFiJykuY3NzKCdkaXNwbGF5JywnYmxvY2snKTtcclxuICAgIH0pO1xyXG5cclxuICAgICQoXCIuc2lnbl91cC1idG5cIikuY2xpY2soZnVuY3Rpb24oKXtcclxuICAgICAgJCgnI2NyZWF0ZS1wb3B1cCcpLmNzcygnZGlzcGxheScsJ2Jsb2NrJyk7XHJcbiAgICAgICQoJy5sb2dpbi1idG4tdGFiJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAkKCcuY3JlYXRlLWJ0bi10YWInKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICQoJyNsb2dpbi1wb3B1cCcpLmNzcygnZGlzcGxheScsJ25vbmUnKTtcclxuICAgICAgJCgnI3Jlc2V0JykuY3NzKCdkaXNwbGF5Jywnbm9uZScpO1xyXG4gICAgICAkKCcudGFiJykuY3NzKCdkaXNwbGF5JywnYmxvY2snKTtcclxuICAgIH0pO1xyXG5cclxuICAgICQoXCIuY2FudF9sb2dpblwiKS5jbGljayhmdW5jdGlvbigpe1xyXG4gICAgICAkKCcjcmVzZXQnKS5jc3MoJ2Rpc3BsYXknLCdibG9jaycpO1xyXG4gICAgICAkKCcjY3JlYXRlLXBvcHVwJykuY3NzKCdkaXNwbGF5Jywnbm9uZScpO1xyXG4gICAgICAkKCcjbG9naW4tcG9wdXAnKS5jc3MoJ2Rpc3BsYXknLCdub25lJyk7XHJcbiAgICAgICQoJy50YWInKS5jc3MoJ2Rpc3BsYXknLCdub25lJyk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAkKFwiI3Jlc2V0ID4gLmJhY2tcIikuY2xpY2soZnVuY3Rpb24oKSB7XHJcbiAgICAgICQoXCIjcmVzZXRcIikuY3NzKFwiZGlzcGxheVwiLFwibm9uZVwiKTtcclxuICAgICAgJCgnI2xvZ2luLXBvcHVwJykuY3NzKCdkaXNwbGF5JywnYmxvY2snKTtcclxuICAgICAgJChcIi50YWJcIikuY3NzKFwiZGlzcGxheVwiLFwiYmxvY2tcIik7XHJcbiAgICB9KTtcclxuXHJcbi8vIERlbW8gbW9kYWxzXHJcbiAgJChcIi5mZF8xXCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19mZCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5mZDEnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcbiAgJChcIi5mZF8yXCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19mZCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5mZDInKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcbiAgJChcIi5mZF8zXCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19mZCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5mZDMnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcbiAgJChcIi5mZF80XCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19mZCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5mZDQnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcbiAgJChcIi5lcl8xXCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19lcicpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5lcjEnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcbiAgJChcIi5lcl8yXCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19lcicpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5lcjInKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcbiAgJChcIi5lcl8zXCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19lcicpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5lcjMnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcbiAgJChcIi5lcl80XCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19lcicpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5lcjQnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcbiAgJChcIi5iYWNrXCIpLm9uKCdjbGljayB0b3VjaGVuZCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuZGVtb19mZCcpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5kZW1vX2VyJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xyXG4gICAgJCgnLmZkMScpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5mZDInKS5hZGRDbGFzcygnZC1ub25lJyk7XHJcbiAgICAkKCcuZmQzJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xyXG4gICAgJCgnLmZkNCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5lcjEnKS5hZGRDbGFzcygnZC1ub25lJyk7XHJcbiAgICAkKCcuZXIyJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xyXG4gICAgJCgnLmVyMycpLmFkZENsYXNzKCdkLW5vbmUnKTtcclxuICAgICQoJy5lcjQnKS5hZGRDbGFzcygnZC1ub25lJyk7XHJcbiAgfSk7XHJcblxyXG4vLyBUYWJzIGxvZ2luIHBvcHVwXHJcbiAgZnVuY3Rpb24gdGFiX2xvZ2luKGV2dCwgdGFiKSB7XHJcbiAgICB2YXIgaSwgdGFiY29udGVudCwgdGFibGlua3M7XHJcbiAgICB0YWJjb250ZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcInRhYmNvbnRlbnRcIik7XHJcbiAgICBmb3IgKGkgPSAwOyBpIDwgdGFiY29udGVudC5sZW5ndGg7IGkrKykge1xyXG4gICAgICB0YWJjb250ZW50W2ldLnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcclxuICAgIH1cclxuICAgIHRhYmxpbmtzID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcInRhYmxpbmtzXCIpO1xyXG4gICAgZm9yIChpID0gMDsgaSA8IHRhYmxpbmtzLmxlbmd0aDsgaSsrKSB7XHJcbiAgICAgIHRhYmxpbmtzW2ldLmNsYXNzTmFtZSA9IHRhYmxpbmtzW2ldLmNsYXNzTmFtZS5yZXBsYWNlKFwiIGFjdGl2ZVwiLCBcIlwiKTtcclxuICAgIH1cclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKHRhYikuc3R5bGUuZGlzcGxheSA9IFwiYmxvY2tcIjtcclxuICAgIGV2dC5jdXJyZW50VGFyZ2V0LmNsYXNzTmFtZSArPSBcIiBhY3RpdmVcIjtcclxuICB9XHJcblxyXG4vLyBNZW51IGRhc2hib2FyZFxyXG4gICQoJy5tZW51Jykub24oJ3RvdWNoIGNsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICQoJyNtZW51JykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZV9tZW51Jyk7XHJcbiAgICAkKCcudG9wbmF2JykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gIH0pO1xyXG5cclxuLy8gU2xvdyBzY3JvbGwgb24gZG9jcyAgXHJcbiAgLy8gYWRkIGFjdGl2ZSBjbGFzcyB0byBuYXZcclxuICBqUXVlcnkod2luZG93KS5zY3JvbGwoZnVuY3Rpb24oKXtcclxuICAgIHZhciAkc2VjdGlvbnMgPSAkKCcubGluaycpO1xyXG4gICAgJHNlY3Rpb25zLmVhY2goZnVuY3Rpb24oaSxlbCl7XHJcbiAgICAgIGlmKCQod2luZG93KS53aWR0aCgpID4gNTYwKXtcclxuICAgICAgICB2YXIgdG9wICA9ICQoZWwpLm9mZnNldCgpLnRvcCAtIDEwMDtcclxuICAgICAgICB2YXIgYm90dG9tID0gIHRvcCArJChlbCkuaGVpZ2h0KCk7XHJcbiAgICAgICAgdmFyIHNjcm9sbCA9ICQod2luZG93KS5zY3JvbGxUb3AoKSArIDEwMDtcclxuICAgICAgICB2YXIgaWQgPSAkKGVsKS5hdHRyKCdpZCcpO1xyXG4gICAgICB9IGVsc2V7XHJcbiAgICAgICAgdmFyIHRvcCAgPSAkKGVsKS5vZmZzZXQoKS50b3A7XHJcbiAgICAgICAgdmFyIGJvdHRvbSA9ICB0b3AgKyQoZWwpLmhlaWdodCgpO1xyXG4gICAgICAgIHZhciBzY3JvbGwgPSAkKHdpbmRvdykuc2Nyb2xsVG9wKCk7XHJcbiAgICAgICAgdmFyIGlkID0gJChlbCkuYXR0cignaWQnKTtcclxuICAgICAgfVxyXG4gICAgICBpZiggc2Nyb2xsID4gdG9wICYmIHNjcm9sbCA8IGJvdHRvbSl7XHJcbiAgICAgICAgJCgnLnZlcnRpY2FsLW5hdiA+IHVsID4gbGkuYWN0aXZlJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQoJ2FbaHJlZj1cIiMnK2lkKydcIl0nKS5wYXJlbnQoJ2xpJykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICB9XHJcbiAgICB9KVxyXG4gIH0pO1xyXG4gIC8vIHNsb3cgc2Nyb2xsXHJcbiAgJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKXtcclxuICAgICQoXCIjZG9jc1wiKS5vbihcImNsaWNrXCIsXCJhXCIsIGZ1bmN0aW9uIChldmVudCkge1xyXG4gICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICB2YXIgaWQgID0gJCh0aGlzKS5hdHRyKCdocmVmJyksXHJcbiAgICAgIHRvcCA9ICQoaWQpLm9mZnNldCgpLnRvcCAtIDEwMDtcclxuICAgICAgJCgnYm9keSxodG1sJykuYW5pbWF0ZSh7c2Nyb2xsVG9wOiB0b3B9LCA4MDApO1xyXG4gICAgfSk7XHJcbiAgfSk7XHJcblxyXG4vLyBTY3JvbGwgdG8gbmV4dCBzY3JlZW5cclxuICBuZXcgZnVsbHBhZ2UoJyNmdWxscGFnZScsIHtcclxuICAgIGxpY2Vuc2VLZXk6ICdGNEQ3MTA4OS0yMTRGNDMxNS05NThEMUU5Mi0xMDlERDZENCcsXHJcbiAgICByZWNvcmRIaXN0b3J5OiBmYWxzZSxcclxuICAgIHNlY3Rpb25TZWxlY3RvcjogJ3NlY3Rpb24nLFxyXG4gICAgcmVzcG9uc2l2ZUhlaWdodDogJzYwMCcsXHJcbiAgICByZXNwb25zaXZlV2lkdGg6ICc1NjAnLFxyXG4gICAgbm9ybWFsU2Nyb2xsRWxlbWVudHM6ICcuZmFuY3lib3gtY29udGFpbmVyJywgICAgXHJcbiAgICBmaXRUb1NlY3Rpb246IHRydWUsXHJcbiAgICBkcmFnQW5kTW92ZTp0cnVlLFxyXG4gICAgc2Nyb2xsT3ZlcmZsb3c6ZmFsc2VcclxuICB9KTtcclxuICBuZXcgZnVsbHBhZ2UoJyNkb2NzJywge1xyXG4gICAgbGljZW5zZUtleTogJ0Y0RDcxMDg5LTIxNEY0MzE1LTk1OEQxRTkyLTEwOURENkQ0JyxcclxuICAgIHJlY29yZEhpc3Rvcnk6IGZhbHNlLFxyXG4gICAgc2VjdGlvblNlbGVjdG9yOiAnc2VjdGlvbicsXHJcbiAgICByZXNwb25zaXZlSGVpZ2h0OiAnNjAwJyxcclxuICAgIHJlc3BvbnNpdmVXaWR0aDogJzU2MCcsXHJcbiAgICBub3JtYWxTY3JvbGxFbGVtZW50czogJy5mYW5jeWJveC1jb250YWluZXInLFxyXG4gICAgZml0VG9TZWN0aW9uOiB0cnVlLFxyXG4gICAgZHJhZ0FuZE1vdmU6dHJ1ZSxcclxuICAgIHNjcm9sbE92ZXJmbG93OmZhbHNlXHJcbiAgfSk7XHJcblxyXG4gIFxyXG4vLyBTdG9wIHNjcm9sbCB3aGVuIG1vZGFsIGlzIG9wZW5cclxuICAkKCdbZGF0YS1mYW5jeWJveF0nKS5mYW5jeWJveCh7ICAgXHJcbiAgICBhZnRlckxvYWQ6IGZ1bmN0aW9uKGluc3RhbmNlLCBzbGlkZSkgeyAgICBcclxuICAgICAgZnVsbHBhZ2VfYXBpLnNldEFsbG93U2Nyb2xsaW5nKGZhbHNlKTtcclxuICAgIH0sXHJcbiAgICBhZnRlckNsb3NlOiBmdW5jdGlvbihpbnN0YW5jZSwgc2xpZGUpIHtcclxuICAgICAgZnVsbHBhZ2VfYXBpLnNldEFsbG93U2Nyb2xsaW5nKHRydWUpO1xyXG4gICAgfVxyXG4gIH0pO1xyXG5cclxuLy8gU2hvdyBoaWRkZW4gcGFzc3dvcmRcclxuICAkKGZ1bmN0aW9uKCl7XHJcbiAgICAkKCcuaGlkZS1zaG93Jykuc2hvdygpO1xyXG4gICAgJCgnLmhpZGUtc2hvdyBzcGFuJykuYWRkQ2xhc3MoJ3Nob3cnKTtcclxuICAgIFxyXG4gICAgJCgnLmhpZGUtc2hvdyBzcGFuJykuY2xpY2soZnVuY3Rpb24oKXtcclxuICAgICAgaWYoICQodGhpcykuaGFzQ2xhc3MoJ3Nob3cnKSApIHtcclxuICAgICAgICAkKHRoaXMpLnRleHQoJ0hpZGUnKTtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnNpYmxpbmdzKCcucGFzc3dvcmQnKS5hdHRyKCd0eXBlJywndGV4dCcpO1xyXG4gICAgICAgICQodGhpcykucmVtb3ZlQ2xhc3MoJ3Nob3cnKTtcclxuICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgJCh0aGlzKS50ZXh0KCdTaG93Jyk7XHJcbiAgICAgICAgICQodGhpcykucGFyZW50KCkuc2libGluZ3MoJy5wYXNzd29yZCcpLmF0dHIoJ3R5cGUnLCdwYXNzd29yZCcpO1xyXG4gICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdzaG93Jyk7XHJcbiAgICAgIH1cclxuICAgIH0pO1xyXG4gICAgXHJcbiAgICAkKCdidXR0b24ubG9naW4nKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAkKCcuaGlkZS1zaG93IHNwYW4nKS50ZXh0KCdTaG93JykuYWRkQ2xhc3MoJ3Nob3cnKTtcclxuICAgICAgJCgnLmhpZGUtc2hvdycpLnBhcmVudCgpLmZpbmQoJy5wYXNzd29yZCcpLmF0dHIoJ3R5cGUnLCdwYXNzd29yZCcpO1xyXG4gICAgfSk7IFxyXG4gIH0pO1xyXG5cclxuLy8gSGlkZSBuYW1lIHdoZW4gaW5wdXQgZm9jdXNcclxuICAkKCdpbnB1dFt0eXBlPVwidGV4dFwiXSwgaW5wdXRbdHlwZT1cInBhc3N3b3JkXCJdLCBpbnB1dFt0eXBlPVwiZW1haWxcIl0nKS5mb2N1cyhmdW5jdGlvbigpIHtcclxuICAgICQodGhpcykuc2libGluZ3MoJ3NwYW4nKS5jc3MoJ2Rpc3BsYXknLCdub25lJyk7XHJcbiAgICAkKHRoaXMpLmNzcygncGFkZGluZycsJzE1cHgnKTtcclxuICAgICQodGhpcykuc2libGluZ3MoJy5oaWRlLXNob3cnKS5jc3MoJ3RvcCcsJzE1cHgnKTtcclxuICAgICQodGhpcykucGFyZW50KFwiOmJlZm9yZVwiKS5jc3MoJ3RvcCcsJzIwcHgnKTtcclxuICB9KTtcclxuICAkKCdpbnB1dFt0eXBlPVwidGV4dFwiXSwgaW5wdXRbdHlwZT1cInBhc3N3b3JkXCJdLCBpbnB1dFt0eXBlPVwiZW1haWxcIl0nKS5ibHVyKGZ1bmN0aW9uKCkge1xyXG4gICAgaWYoICQodGhpcykudmFsKCkgKSB7XHJcbiAgICAgICQodGhpcykuc2libGluZ3MoJ3NwYW4nKS5jc3MoJ2Rpc3BsYXknLCdub25lJyk7XHJcbiAgICAgICQodGhpcykuY3NzKCdwYWRkaW5nJywnMTVweCcpO1xyXG4gICAgICAkKHRoaXMpLnNpYmxpbmdzKCcuaGlkZS1zaG93JykuY3NzKCd0b3AnLCcxNXB4Jyk7XHJcbiAgICAgICQodGhpcykucGFyZW50KFwiOmJlZm9yZVwiKS5jc3MoJ3RvcCcsJzIwcHgnKTtcclxuICAgIH1lbHNle1xyXG4gICAgICAkKHRoaXMpLnNpYmxpbmdzKCdzcGFuJykuY3NzKCdkaXNwbGF5JywnYmxvY2snKTtcclxuICAgICAgJCh0aGlzKS5jc3MoJ3BhZGRpbmcnLCcwIDAgMTBweCAxMHB4Jyk7XHJcbiAgICAgICQodGhpcykuc2libGluZ3MoJy5oaWRlLXNob3cnKS5jc3MoJ3RvcCcsJzI0cHgnKTtcclxuICAgIH1cclxuICB9KTtcclxuICAvL2luZm8gd2hlbiBlcnJvciBhbmQgZWxzZVxyXG4gICQoXCIuaW5mb1wiKS50ZXh0KFwiaVwiKTtcclxuICBpZigkKFwiLmlucC13clwiKS5oYXNDbGFzcyhcImVycm9yXCIpKXtcclxuICAgICQoXCIuZXJyb3JcIikuY2hpbGRyZW4oXCIuaW5mb1wiKS50ZXh0KFwiIVwiKTtcclxuICB9IGVsc2V7XHJcbiAgICAkKFwiLmVycm9yXCIpLmNoaWxkcmVuKFwiLmluZm9cIikudGV4dChcImlcIik7XHJcbiAgfVxyXG5cclxuXHJcbi8vIERldmVsb3BlZCBieSBuaWtvYWxkckBnbWFpbC5jb20gKDIwMTkpIl19