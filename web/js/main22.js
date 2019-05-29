// Horizontall bar 100%
// var badDay = 100;
// var betterDay = 100;
    var paymentPeriod =  new Chart(document.getElementById("bar-chart-horizontal"), {
      type: "horizontalBar",
      data: {
        labels: ["Foo"],
        datasets: [
          { label: "bad", data: [badDay], backgroundColor: "#9eaeff" },
          { label: "better", data: [betterDay], backgroundColor: "rgba(255, 255, 255, 0.3)" }
        ]
      },
      options: {
        plugins: {
          stacked100: { enable: true }
        },
        legend: {
            display: false,
        },
        scales: {
            xAxes: [{
                display: false
            }],
            yAxes: [{
                display: false
            }]
        }
      }
    });

// Chart line big
//     var time = ['Mar 4',6,8,10,12,14,16,18,20,22,24,26,28,30,'Apr 1',3,5,7,9];
//     var time = ['Mar 4',6,8,10,12,14,16,18,20,22,24,26,28,30,'Apr 1',3,5,7,9];
//
//     var fd = [5,7,1,24,13,28,40,14,38,11,22,16,34,19,1,14,38,11,22];
//     var er = [38,11,22,16,34,19,1,14,5,7,1,24,13,28,40,14,5,7,1];

    var ctx = document.getElementById('myChart').getContext("2d");

    var gradientFd = ctx.createLinearGradient(0, 0, 0, 250);
    gradientFd.addColorStop(0, 'rgba(133, 93, 248, 0.9)');
    gradientFd.addColorStop(1, 'rgba(60, 45, 169, 0.9)');

    var gradientEr = ctx.createLinearGradient(0, 0, 0, 250);
    gradientEr.addColorStop(0, 'rgba(84, 240, 255, 0.9)');
    gradientEr.addColorStop(1, 'rgba(18, 125, 176, 0.9)');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: time,
            datasets: [
            {
                label: "Face detector",
                borderColor: gradientFd,
                pointRadius: 3,
                pointBackgroundColor: 'transparent',
                pointBorderColor: 'transparent',
                fill: true,
                backgroundColor: gradientFd,
                borderWidth: 1,
                data: fd,
                lineTension: 0
            },
            {
                label: "Emotion recognition",
                borderColor: gradientEr,
                pointRadius: 3,
                pointBackgroundColor: 'transparent',
                pointBorderColor: 'transparent',
                fill: true,
                backgroundColor: gradientEr,
                borderWidth: 1,
                data: er,
                lineTension: 0
            }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                backgroundColor: 'rgba(30, 37, 73, 0.5)',
                titleFontFamily: 'inherit',
                height: '100%',
                position:'nearest',
                bodyFontColor: '#a9b2e1',
                bodyFontSize:14,
                bodySpacing:30,
                xPadding:20,
                yPadding:25,
                cornerRadius:0,
                multiKeyBackground: 'transparent',
                enabled: true,
                intersect:false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            maintainAspectRatio: false,
            legend: {
                display:false,
                position: "right",
                labels: {
                    fontColor: '#54F0FF',
                    fontSize: '14',
                    lineHeight: '20px',
                    usePointStyle:true,
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "#6673B4",
                        maxTicksLimit: 5,
                        padding: 14
                    },
                    gridLines: {
                        drawTicks: true,
                        lineWidth: 1,
                        color: "rgba(102, 115, 180, 0.2)"
                    }

                }],
                xAxes: [{
                    gridLines: {
                        zeroLineColor: "#fff",
                        display: false
                    },
                    ticks: {
                        padding: 8,
                        fontColor: "#6673B4"
                    }
                }]
            }
        }
    });
    
// Doughnut chart

  //get the doughnut chart canvas
  var ctx1 = $("#doughnut-chartcanvas-1");

  //doughnut chart data
  var data1 = {
    labels: ["Face detector", "Emotion recognition"],
    datasets: [
      {
        data: [fd_circle, er_circle],
        backgroundColor: [
          "#54f0ff",
          "#855df8"
        ],
        borderColor: [
          "#54f0ff",
          "#855df8"
        ]
      }
    ]
  };

  //options
  var options = {
    responsive: true,
    title: {
      display: false
    },
    cutoutPercentage: 98,
    legend: {
      display: false
    }
  };

  //create Chart class object
  var chart1 = new Chart(ctx1, {
    type: "doughnut",
    data: data1,
    options: options
  });

// Mini chart
//       var mini_time = ['Mar 4',6,8,10,12,14,16,18,20,22,24,26,28,30,'Apr 1',3,5];
//
//       var mini_fd = [5,7,1,24,13,28,40,14,38,11,22,16,34,19,1,14,38,11,22];
//       var mini_er = [38,11,22,16,34,19,1,14,5,7,1,24,13,28,40,14,5,7,1];

      var btx = document.getElementById('myChartMini').getContext("2d");

      var gradientFd_mini = btx.createLinearGradient(0, 0, 0, 250);
      gradientFd_mini.addColorStop(0, 'rgba(133, 93, 248, 0.9)');
      gradientFd_mini.addColorStop(1, 'rgba(60, 45, 169, 0.9)');

      var gradientEr_mini = btx.createLinearGradient(0, 0, 0, 250);
      gradientEr_mini.addColorStop(0, 'rgba(84, 240, 255, 0.9)');
      gradientEr_mini.addColorStop(1, 'rgba(18, 125, 176, 0.9)');

      var myChart = new Chart(btx, {
          type: 'line',
          data: {
              labels: mini_time,
              datasets: [
              {
                  label: "Fd",
                  borderColor: gradientFd_mini,
                  pointRadius: 3,
                  pointBackgroundColor: 'transparent',
                  pointBorderColor: 'transparent',
                  fill: true,
                  backgroundColor: gradientFd_mini,
                  borderWidth: 1,
                  data: mini_fd,
                  lineTension: 0
              },
              {
                  label: "Er",
                  borderColor: gradientEr_mini,
                  pointRadius: 3,
                  pointBackgroundColor: 'transparent',
                  pointBorderColor: 'transparent',
                  fill: true,
                  backgroundColor: gradientEr_mini,
                  borderWidth: 1,
                  data: mini_er,
                  lineTension: 0
              }
              ]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              legend: {
                  display:false,
                  position: "right",
                  labels: {
                      fontColor: '#54F0FF',
                      fontSize: '14',
                      lineHeight: '20'
                  }
              },
              scales: {
                  yAxes: [{
                      ticks: {
                          fontColor: "#6673B4",
                          maxTicksLimit: 5,
                          padding: 14,
                          display:false
                      },
                      gridLines: {
                          drawTicks: true,
                          lineWidth: 1,
                          color: "rgba(102, 115, 180, 0.2)",
                          display:false
                      }

                  }],
                  xAxes: [{
                      gridLines: {
                          zeroLineColor: "#fff",
                          display: false
                      },
                      ticks: {
                          padding: 8,
                          fontColor: "#6673B4",
                          display:false
                      }
                  }]
              }
          }
      });

// Payments tabs
    function year(evt, year) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(year).style.display = "block";
      evt.currentTarget.className += " active";
    }

// Modal windows
  $('[data-fancybox="gallery"]').fancybox({

  });

// Accordion
  // payments accordion
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "table-row") {
          panel.style.display = "none";
        } else {
          panel.style.display = "table-row";
        }
      });
    }
  // keys accordion
    function keysAccordion() {
        if($(window).width() < 560)
        {   
           var keyAcc = document.getElementsByClassName("keys"); 
           var j; 

           for (j = 0; j < keyAcc.length; j++) { 
             keyAcc[j].addEventListener('click', function(event) { 
               this.classList.toggle('active');

               var panel = this.nextElementSibling;

               while (panel) { 
               if (!panel.classList.contains('hidden-buttons-keys')) { 
                 break; 
               } 

               panel.classList.toggle('d-none'); 
               panel = panel.nextElementSibling; 
               } 
             }) 
           }             
        }
    }
    keysAccordion();

    $(window).resize(function() {
        keysAccordion();
    });
    
// Mobile menu fixed
  $(window).scroll(function(){
    var wScroll = $(this).scrollTop();

    if (wScroll > 90) {
      $('.mobile-nav').addClass('active');
    }
    else {
      $('.mobile-nav').removeClass('active');
    };
  });

// Menu dashboard
  document.querySelector(".menu").addEventListener("click", topMenu);
  document.querySelector("#menuDesctop").addEventListener("click", topMenu);
  function topMenu() {
    var x = document.getElementById("menu");
    if (x.style.height === "auto") {
      x.style.height = "0";
    } else {
      x.style.height = "auto";
    }
  }

// Chart mobile mini
  var time = ['Mar 4',6,8,10,12,14,16,18,20,22,24,26,28,30,'Apr 1',3,5];

  var fd = [5,7,1,24,13,28,40,14,38,11,22,16,34,19,1,14,38,11,22];
  var er = [38,11,22,16,34,19,1,14,5,7,1,24,13,28,40,14,5,7,1];

  var ctx = document.getElementById('mobile-chart').getContext("2d");

  var gradientFd = ctx.createLinearGradient(0, 0, 0, 250);
  gradientFd.addColorStop(0, 'rgba(133, 93, 248, 0.9)');
  gradientFd.addColorStop(1, 'rgba(60, 45, 169, 0.9)');

  var gradientEr = ctx.createLinearGradient(0, 0, 0, 250);
  gradientEr.addColorStop(0, 'rgba(84, 240, 255, 0.9)');
  gradientEr.addColorStop(1, 'rgba(18, 125, 176, 0.9)');

  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: time,
          datasets: [
          {
              label: "Face detector",
              borderColor: gradientFd,
              pointRadius: 3,
              pointBackgroundColor: 'transparent',
              pointBorderColor: 'transparent',
              fill: true,
              backgroundColor: gradientFd,
              borderWidth: 1,
              data: fd,
              lineTension: 0
          },
          {
              label: "Emotion recognition",
              borderColor: gradientEr,
              pointRadius: 3,
              pointBackgroundColor: 'transparent',
              pointBorderColor: 'transparent',
              fill: true,
              backgroundColor: gradientEr,
              borderWidth: 1,
              data: er,
              lineTension: 0
          }
          ]
      },
      options: {
          responsive: true,
          tooltips: {
              mode: 'index',
              intersect: false,
              backgroundColor: 'rgba(30, 37, 73, 0.5)',
              titleFontFamily: 'inherit',
              height: '100%',
              position:'nearest',
              bodyFontColor: '#a9b2e1',
              bodyFontSize:14,
              bodySpacing:30,
              xPadding:20,
              yPadding:25,
              cornerRadius:0,
              multiKeyBackground: 'transparent',
              enabled: true
          },
          maintainAspectRatio: false,
          legend: {
              display:false
          },
          scales: {
              yAxes: [{
                  ticks: {
                      display:false,
                      beginAtZero: true
                  },
                  gridLines: {
                      display:false,
                      tickMarkLength: 0
                  }

              }],
              xAxes: [{
                  gridLines: {
                      display: false,
                      tickMarkLength: 0
                  },
                  ticks: {
                      display:false,
                      beginAtZero: true
                  }
              }]
          }
      }
  });

// Chart mobile full
  var time = ['Mar 4',6,8,10,12,14,16,18,20,22,24,26,28,30,'Apr 1',3,5];

  var fd = [5,7,1,24,13,28,40,14,38,11,22,16,34,19,1,14,38,11,22];
  var er = [38,11,22,16,34,19,1,14,5,7,1,24,13,28,40,14,5,7,1];

  var ctx = document.getElementById('graph-mobile').getContext("2d");

  var gradientFd = ctx.createLinearGradient(0, 0, 0, 250);
  gradientFd.addColorStop(0, 'rgba(133, 93, 248, 0.9)');
  gradientFd.addColorStop(1, 'rgba(60, 45, 169, 0.9)');

  var gradientEr = ctx.createLinearGradient(0, 0, 0, 250);
  gradientEr.addColorStop(0, 'rgba(84, 240, 255, 0.9)');
  gradientEr.addColorStop(1, 'rgba(18, 125, 176, 0.9)');

  var graph_mobile = new Chart(ctx, {
      type: 'line',
      data: {
          labels: time,
          datasets: [
          {
              label: "Face detector",
              borderColor: gradientFd,
              pointRadius: 3,
              pointBorderColor: 'transparent',
              fill: false,
              backgroundColor: gradientFd,
              borderWidth: 3,
              data: fd,
              lineTension: 0
          },
          {
              label: "Emotion recognition",
              borderColor: gradientEr,
              pointRadius: 3,
              pointBorderColor: 'transparent',
              fill: false,
              backgroundColor: gradientEr,
              borderWidth: 3,
              data: er,
              lineTension: 0
          }
          ]
      },
      options: {
          responsive: true,
          tooltips: {
              mode: 'index',
              intersect: false,
              backgroundColor: 'rgba(30, 37, 73, 0.5)',
              titleFontFamily: 'inherit',
              height: '100%',
              position:'nearest',
              bodyFontColor: '#a9b2e1',
              bodyFontSize:14,
              bodySpacing:30,
              xPadding:20,
              yPadding:25,
              cornerRadius:0,
              multiKeyBackground: 'transparent',
              enabled: true
          },
          hover: {
              mode: 'nearest',
              intersect: true
          },
          maintainAspectRatio: false,
          legend: {
              display:false,
              position: "right",
              labels: {
                  fontColor: '#54F0FF',
                  fontSize: '14',
                  lineHeight: '20px',
                  usePointStyle:true,
              }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      fontColor: "#6673B4",
                      maxTicksLimit: 5,
                      padding: 14,
                      display:false,
                      beginAtZero: true
                  },
                  gridLines: {
                      drawTicks: true,
                      lineWidth: 1,
                      color: "rgba(102, 115, 180, 0.2)"
                  }

              }],
              xAxes: [{
                  gridLines: {
                      zeroLineColor: "#fff",
                      display: false
                  },
                  ticks: {
                      padding: 8,
                      fontColor: "#6673B4",
                      beginAtZero: true
                  }
              }]
          }
      }
  });

// Mobile detail button
  $('#mobile-dashboard-detail').click(function () {
      $('.dashboard-info .main-info .table-wrapper:nth-child(3)').css('display','block');
      $('.dashboard-info .main-info .table-wrapper:nth-child(2)').css('display','none');
  });

// Visible change password
  $(".change_pass-btn").click(function(){
    $(".password").toggleClass('d-block');
  });

// Change bg near logo when dashboard is active
  if ($(".dashboard-info .dashboard_left-bar .nav .list_item:nth-child(1)").hasClass('active')) {
    $('.dashboard-info .dashboard_left-bar').css('background','url(../img/method-draw-image.svg)no-repeat');
  }

// Show hidden password
  $(function(){
    $('.hide-show').show();
    $('.hide-show span').addClass('show');
    
    $('.hide-show span').click(function(){
      if( $(this).hasClass('show') ) {
        $(this).text('Hide');
        $(this).parent().siblings('.password').attr('type','text');
        $(this).removeClass('show');
      } else {
         $(this).text('Show');
         $(this).parent().siblings('.password').attr('type','password');
         $(this).addClass('show');
      }
    });
    
    $('.change > a').on('click', function(){
      $('.hide-show span').text('Show').addClass('show');
      $('.hide-show').parent().find('.password').attr('type','password');
    }); 
  });

// Developed by nikoaldr@gmail.com (2019)