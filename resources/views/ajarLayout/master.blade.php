<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
            />
            <!-- bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
            <!-- main style -->
            <link rel="stylesheet" href="./main.css" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(window).on('beforeunload', function () {
                        localStorage.setItem('scrollPosition', $(window).scrollTop());
                    });
                    $(window).on('load', function () {
                        $(window).scrollTop(localStorage.getItem('scrollPosition'));
                    });
                    var element = document.getElementById("myId");
                    window.scrollTo(0, element.offsetTop);

                </script>
            <title>Flexbook</title>
            <style >
                #images-container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                }

                #images-container img {
                    width: 30%;
                    margin-bottom: 10px;
                }
                .xuxw1ft {
                    white-space: nowrap;
 
                }
                .my-anchor {
                    position: relative; /* set the position of the anchor tab */
                }
                .my-anchor:hover:before {
                    content: "Hover Title";
                    position: absolute; /* position the title in relation to the anchor tab */
                    top: 40px; /* adjust the position of the title */
                    left: 0;
                    background-color: #f1f1f1; /* set the background color of the title */
                    padding: 4px 8px; /* add some padding to the title */
                    border-radius: 4px; /* add some border radius to the title */
                    font-size: 12px; /* set the font size of the title */
                    font-weight: bold; /* set the font weight of the title */
                    color: #333; /* set the color of the title */
                    z-index: 1; /* set the z-index so that the title appears above the anchor tab */
                }
                .icon {
                    transition: transform 0.5s ease-in-out; /* Add a transition to the icon */
                }
                .my-anchor:hover .icon {
                    transform: rotate(360deg);
                }
                
            </style>
        </head>
        <body class="bg-gray postion-relative">
            <!-- ================= Appbar ================= -->
            <div class="bg-white d-sm-flex align-items-center fixed-top shadow" style="min-height: 56px; z-index: 5">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- search -->
                        <div class="col-sm-2 d-sm-flex align-items-center">
                            <!-- logo -->
                            <i class="fab fa-facebook text-success" style="font-size: 3rem"></i>
                            <!-- search bar -->
                        </div>
                        <!-- nav -->
                        <div class="col-sm-8 d-none d-sm-flex justify-content-center">
                            <!-- home -->
                            <div class="mx-4 nav__btn">
                                <a type="button" href="{{ route('ajarLayout.newsfeed') }}" class="my-anchor btn px-4">
                                <i class="fas fa-check-circle text-success fs-2"></i>
                                <span class="icon fa fa-arrow-up">&#x25B2;</span> 
                                </a>
                            </div>
                            <!-- market -->
                            <div class="mx-4 nav__btn">
                                <a type="button" href="{{ route('ajarLayout.newsfeed') }}" class="my-anchor btn px-4"> 
                                <i class="fas fa-check-circle text-danger fs-2"></i>
                                </a>
                            </div>
                            <!-- group -->
                            <div class="mx-4 nav__btn">
                                <a type="button" class="my-anchor btn px-4" href="#">
                                <i
                                class=" fab fa-gratipay text-warning fs-2"
                                >
                                
                                </i>
                                </a>
                            </div>
                            <!-- gaming -->
                            <div class="mx-4 nav__btn">
                                <a type="button" class="my-anchor btn px-4" href="#">
                                <i class="fas fa-user-circle text-dark fs-2"></i>
                                </a>
                            </div>
                            <div class="mx-4 nav__btn">
                                <a type="button" class="my-anchor btn px-4" href="#">
                                <i  class="fas fa-cog text-primary fs-2"></i>
                                </a>
                            </div>
                                <form action="{{ route('logout') }}" method="post">
                            <div class="mx-4 nav__btn">
                                    @csrf
                                <button type="submit" class="my-anchor btn px-4" title="logout">
                                <i  class="fas fa-sign-out-alt text-primary fs-2"></i>
                                </button>
                            </div>
                                </form>
                        </div>
                        <div class="col-sm-2">
                        </div>
                        <!-- menus -->
                    </div>
                </div>
            </div>
            <!-- =============== New Chat Mobile =============== -->
            <!-- ================= Chat Modal Mobile ================= -->
            <!-- chat 1 -->
            <!-- chat 2 -->
            <!-- message input -->
            <!-- chat 3 -->
            <!-- chat 4 -->
            <!-- chat 5 -->
            <!-- ================= Main ================= -->
            <!-- <div class="container-fluid">
                <div class="row justify-content-evenly">
                    <!-- ================= Sidebar ================= -->
                    <!-- <div class="col-12 col-lg-3">
                        <div
                            class="d-none d-xxl-block h-100 fixed-top overflow-hidden scrollbar"
                            style="max-width: 360px; width: 100%; z-index: 4"
                            >
                            <!-- terms -->
                            <!-- <div class="p-2 mt-5">
                                <p class="text-muted fs-7">
                                    Privacy &#8226; Terms &#8226; Advertising &#8226; Ad Choices
                                    &#8226; Cookies &#8226; Flexbook © 2021
                                </p>
                            </div>
                        </div>
                    </div> -->
                    <!-- ================= Timeline ================= -->
                   <!-- main content -->
                    @yield('main-content')
                   <!-- end main content -->
                    </body>
                </html>