<?php 
 $connect = mysqli_connect("mysql.hostinger.com.br", "u942257283_nupso", "nupsolxyz", "u942257283_banco");   
 $query = "SELECT * FROM backup ORDER BY id desc";  
 $result = mysqli_query($connect, $query);  
 ?>  

<!DOCTYPE html>
<html >
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.6.5, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logonupsol-609x128.png" type="image/x-icon">
  <meta name="description" content="Website Builder Description">
  <title>PAINEIS</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&subset=latin">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/animate.css/animate.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

  



  
  
</head>
<body>
  <section id="menu-6t" data-rv-view="400">

    <nav class="navbar navbar-dropdown">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="index.html" class="navbar-logo"><img src="assets/images/logonupsol-609x128.png" alt="Mobirise"></a>
                        <a class="navbar-caption" href="index.html#msg-box8-h"></a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar"><li class="nav-item"><a class="nav-link link" href="index.html#msg-box8-h">INICIO</a></li><li class="nav-item dropdown"><a class="nav-link link" href="page2.html" aria-expanded="false">QUEM SOMOS</a></li><li class="nav-item"><a class="nav-link link" href="page3.html#header3-v">MEMBROS</a></li><li class="nav-item"><a class="nav-link link" href="page4.html">EVENTOS</a></li><li class="nav-item"><a class="nav-link link" href="page14.html" aria-expanded="false">PROJETOS</a></li><li class="nav-item"><a class="nav-link link" href="page1.html#form1-f">CONTATO</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a href="https://mobirise.ws/i">how to build free website</a></section><section class="mbr-section mbr-section__container article mbr-after-navbar" id="header3-6v" data-rv-view="303" style="background-color: rgb(255, 255, 255); padding-top: 140px; padding-bottom: 60px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2">EM DESENVOLVIMENTO</h3>
                <small class="mbr-section-subtitle">Monitoramento Placas Fotovoltaicas</small>
            </div>
        </div>
    </div>



           <br /><br />  
           <div class="container" style="width:auto;">  
                <h2 align="center">Consulta de Banco de Dados</h2>  
                <h3 align="center">Order Data</h3><br />  
                <div class="col-md-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div>  
                <div class="col-md-5">  
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
                </div>  
                <div style="clear:both"></div>  
				
				<div id="chart-container">
					<canvas id="mycanvas"></canvas>
				</div>
				<script type="text/javascript" src="Chart.min.js"></script>
                <br /> 		
				
                <div id="order_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">ID</th>  
                               <th width="30%">date</th>  
                               <th width="43%">Corrente</th>  
                               <th width="10%">Tensao</th>  
                               <th width="12%">Date Server</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["id"]; ?></td>  
                               <td><?php echo $row["date"]; ?></td>  
                               <td><?php echo $row["cmed"]; ?></td>  
                               <td><?php echo $row["vmed"]; ?></td>  
                               <td><?php echo $row["dateserver"]; ?></td>  
                          </tr>  
                     <?php  
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>  
           
  </section>






<br/>
<br/>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-6u" data-rv-view="302" style="background-color: rgb(46, 46, 46); padding-top: 0.875rem; padding-bottom: 1.75rem;">
    
    <div class="container text-xs-center">
        <p>Núcleo de Pesquisa em Energias Renováveis - NuPSOL<br>© COPYRIGHT 2017 - TODOS OS DIREITOS RESERVADOS.</p>
    </div>
</footer>


   <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
  <input name="animation" type="hidden">
  </body>
</html>
 <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });
					 
					 	var urlenv = "data.php";
						urlenv+="?m=1";
						urlenv+="&fd=";
						urlenv+=from_date;
						urlenv+="&";
						urlenv+="td=";
						urlenv+=to_date;
						console.log(urlenv);
						
					$.ajax({

						url: urlenv,

						method: "GET",
						success: function(data) {
							console.log(data);
							var corrente = [];
							var date = [];
							var voltage = [];
							var pot = [];

							for(var i in data) {
								corrente.push(data[i].cmed);//.date é o nome da coluna
								date.push(data[i].date);//.corrente é o nome da coluna
								voltage.push(data[i].vmed);
								pot.push(data[i].cmed*data[i].vmed)
							}

							var chartdata = {
								labels: date,
								datasets : [
									{
										label: 'Tensão(V)',
										backgroundColor: 'rgba(0, 0, 205, 0.75)',
										borderColor: 'rgba(0, 0, 128, 0.75)',
										hoverBackgroundColor: 'rgba(0, 0, 205, 0.75)',
										hoverBorderColor: 'rgba(0, 0, 128, 0.75)',
										data: voltage
										
										
									},
									
									{
										label: 'Corrente(A)',
										backgroundColor: 'rgba(255,215,0)',
										borderColor: 'rgba(255,140,0)',
										hoverBackgroundColor: 'rgba(255,215,0)',
										hoverBorderColor: 'rgba(255,140,0)',
										data: corrente

									},
									
									{
										label: 'Potência(W)',
										backgroundColor: 'rgba(0,255,0)',
										borderColor: 'rgba(0,100,0)',
										hoverBackgroundColor: 'rgba(0,255,0)',
										hoverBorderColor: 'rgba(0,100,0)',
										data: pot

									}
								]
								
								
							};

							var ctx = $("#mycanvas");

							var barGraph = new Chart(ctx, {
								type: 'bar',
								data: chartdata
							});
						},
						error: function(data) {
							console.log(data);
						}
					});
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>
 <script>
 $(document).ready(function(){
	var urlenv = "data.php";
	urlenv+="?m=0";
	$.ajax({
		url: urlenv,
		method: "GET",
		success: function(data) {
			console.log(data);
			var corrente = [];
			var date = [];
			var voltage = [];
			var pot = [];

			for(var i in data) {
				corrente.push(data[i].cmed);//.date é o nome da coluna
				date.push(data[i].date);//.corrente é o nome da coluna
				voltage.push(data[i].vmed);
				pot.push(data[i].cmed*data[i].vmed)
			}

			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'Tensão(V)',
						backgroundColor: 'rgba(0, 0, 205, 0.75)',
						borderColor: 'rgba(0, 0, 128, 0.75)',
						hoverBackgroundColor: 'rgba(0, 0, 205, 0.75)',
						hoverBorderColor: 'rgba(0, 0, 128, 0.75)',
						data: voltage
						
						
					},
					
					{
						label: 'Corrente(A)',
						backgroundColor: 'rgba(255,215,0)',
						borderColor: 'rgba(255,140,0)',
						hoverBackgroundColor: 'rgba(255,215,0)',
						hoverBorderColor: 'rgba(255,140,0)',
						data: corrente

					},
					
					{
						label: 'Potência(W)',
						backgroundColor: 'rgba(0,255,0)',
						borderColor: 'rgba(0,100,0)',
						hoverBackgroundColor: 'rgba(0,255,0)',
						hoverBorderColor: 'rgba(0,100,0)',
						data: pot

					}
				]
				
				
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
</script>
