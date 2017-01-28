<!DOCTYPE html>

<html lang="ar">
<head>
    <title>Hospital</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{!! asset('assets/layout/styles/layout.css')!!}" rel="stylesheet" type="text/css" media="all">
    <script type="text/javascript" src="{!! asset('assets/jquery-3.1.1.min.js')!!}"></script>
    <script>
        
        $(function(){
            //The places List
            $('#fields').on('change', function(){
            	var fieldValue = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/places",
                    data: {field_id:fieldValue},
                    success:function(data){
                        if(data.length > 0){
                            $('#places').attr('disabled', false);
                            $('#places').empty();
                            $('#places').html('<option>اختر مكان</option>');
                            $('#places').each(function(){
                                if (this.tagName=='SELECT') {
                                    var selectElement = this;
                                    $.each(data,function(index, optionData){
                                        var option = new Option(optionData.place_name,
                                        optionData.place_id);
                                        selectElement.add(option);
                                    });
                                }
                            });
                            $('#doctors').attr('disabled', true);
                            $('#doctors').empty();
                            $('#doctors').html('<option>اختر دكتور</option>');
                        }else{
                            $('#places').attr('disabled', false);
                            $('#places').empty();
                            $('#places').html('<option>اختر مكان</option>');
                            $('#doctors').attr('disabled', true);
                            $('#doctors').empty();
                            $('#doctors').html('<option>اختر دكتور</option>');
                        }
                        //Nice Work Do loop of it and remove the disabled
                        
                    },
                    error:function(result){
                        //console.log(result);
                    }
                });
                
            });
            //The Doctors List
            $('#places').on('change', function(){
            	var fieldValue = $('#fields').val();
                var placeValue = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/doctors",
                    data: {field_id:fieldValue, place_id:placeValue},
                    success:function(data){
                        if(data.length > 0){
                            $('#doctors').attr('disabled', false);
                            $('#doctors').empty();
                            $('#doctors').html('<option>اختر دكتور</option>');
                            $('#doctors').each(function(){
                                if (this.tagName=='SELECT') {
                                    var selectElement = this;
                                    $.each(data,function(index, optionData){
                                        var option = new Option(optionData.doctor_name,
                                        optionData.doctor_id);
                                        selectElement.add(option);
                                    });
                                }
                            });
                        }else{
                            $('#doctors').attr('disabled', true);
                            $('#doctors').empty();
                            $('#doctors').html('<option>اختر دكتور</option>');
                        }
                        //Nice Work Do loop of it and remove the disabled
                        
                    },
                    error:function(result){
                        console.log(result);
                    }
                });
                
            });
            
        });

        
        function submitValues(){
            
            var fieldValue = $('#fields').val();
            var placeValue = $('#places').val();
            var doctorValue = $('#doctors').val();
            var token = $('_token').val();
            $.ajax({
                type: 'POST',
                url: '/date',
                data:{_token:token, field_id:fieldValue, place_id:placeValue, doctor_id:doctorValue}
            });

        }
        


    </script>

</head>
<body id="top" dir="ltr">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url({!! asset('assets/images/01.png')!!});">
    <!-- ################################################################################################ -->
    <div class="wrapper row1" style="background-color: transparent;">
        <header id="header" class="hoc clear">
            <!-- ################################################################################################ -->
            <div id="logo" class="fl_right">
                <h1><a href="index.html">LOGO</a></h1>
            </div>
            <nav id="mainav" class="fl_left" style="font-size:150%; ">
                <ul class="clear">
                    <!--<li><a class="drop" href="#">أطباء</a></li>-->
                    <li><a href="#">نحن</a></li>
                    <li><a href="#">أطباء</a></li>
                    <li><a href="#">تخصصات</a></li>
                    <li><a href="index.html">الرئيسية</a></li>
                </ul>
            </nav>

            <!-- ################################################################################################ -->
        </header>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div id="pageintro" class="hoc clear">
        <div class="flexslider basicslider">
            <!-- ################################################################################################ -->
            <ul class="slides">
                <li>
                    <article dir="rtl">
                        {!! Form::open(['method'=> 'post', 'url' => 'date']) !!}
                        <div class="mainRectangle">
                            <select id="fields" class="dropdownlist">
                                <option>اختر تخصص</option>
                                @if(isset($fields) && $fields != null)
                                    @foreach($fields as $field)
                                        <option value="{!! $field->field_id !!}">{!! $field->field_name !!}</option>
                                    @endforeach
                                @endif
                            </select>
                            <!--<footer><a class="btn" href="fields.html" target="_blank">إحجز ميعاد</a></footer>-->

                            <select id="places" class="dropdownlist" disabled="disabled">
                                <option>اختر مكان</option>

                            </select>

                            <select id="doctors" class="dropdownlist" disabled="disabled">
                                <option>اختر دكتور</option>
                                
                            </select>
                            <input type="submit" value="حجز ميعاد" name="reserve" id="button"/>
                        </div>
                        {!! Form::close() !!}
                        <h6 style="font-size: 130%">عيادتى اسهل و اسرع طريقة لحجز دكتورك من اى مكان</h6>
                    </article>
                </li>

                <!-- ################################################################################################ -->
        </div>
    </div>
    <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->


<div class="wrapper row4">
    <footer id="footer" class="hoc clear">
        <!-- ################################################################################################ -->
        <div class="one_third first">
            <h6 class="heading">Eleifend massa curabitur</h6>
            <ul class="nospace btmspace-30 linklist contact">
                <li><i class="fa fa-map-marker"></i>
                    <address>
                        Street Name &amp; Number, Town, Postcode/Zip
                    </address>
                </li>
                <li><i class="fa fa-phone"></i> +00 (123) 456 7890</li>
                <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
            </ul>
            <ul class="faico clear">
                <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
            </ul>
        </div>
        <div class="one_third">
            <h6 class="heading">Sollicitudin lorem suscipit</h6>
            <ul class="nospace linklist">
                <li>
                    <article>
                        <h2 class="nospace font-x1"><a href="#">Vehicula egestas mauris</a></h2>
                        <time class="font-xs block btmspace-10" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045
                        </time>
                        <p class="nospace">Arcu magna quis lectus ut sit amet diam sed massa mattis
                            fermentum&hellip;</p>
                    </article>
                </li>
                <li>
                    <article>
                        <h2 class="nospace font-x1"><a href="#">Purus elit ac pharetra</a></h2>
                        <time class="font-xs block btmspace-10" datetime="2045-04-05">Thursday, 5<sup>th</sup> April
                            2045
                        </time>
                        <p class="nospace">Sed vel augue donec non ultrices dui euismod donec ultricies
                            ultrices&hellip;</p>
                    </article>
                </li>
            </ul>
        </div>
        <div class="one_third">
            <h6 class="heading">Scelerisque fusce lobortis</h6>
            <p class="nospace btmspace-30">Turpis in volutpat tempus praesent a nunc gravida tincidunt odio in
                dapibus.</p>
            <form method="post" action="#">
                <fieldset>
                    <legend>Newsletter:</legend>
                    <input class="btmspace-15" type="text" value="" placeholder="Name">
                    <input class="btmspace-15" type="text" value="" placeholder="Email">
                    <button type="submit" value="submit">Submit</button>
                </fieldset>
            </form>
        </div>
        <!-- ################################################################################################ -->
    </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
    <div id="copyright" class="hoc clear">
        <!-- ################################################################################################ -->
        <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="#">Domain Name</a></p>
        <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/"
                                           title="Free Website Templates">OS Templates</a></p>
        <!-- ################################################################################################ -->
    </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->


<script src="{!! asset('assets/layout/scripts/jquery.backtotop.js')!!}"></script>
<script src="{!! asset('assets/layout/scripts/jquery.mobilemenu.js')!!}"></script>
<script src="{!! asset('assets/layout/scripts/jquery.flexslider-min.js')!!}"></script>
</body>
</html>