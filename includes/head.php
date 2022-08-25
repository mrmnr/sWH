<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The e-commerse site for those who want everything delivered to them">
    <meta name="keywords" content="e-commerse, fiction, books, tv, shows, movies, documentaries, games, game, rpg, rpgs">
   
    <link rel="stylesheet" href="frameworks/bootstrap.css">
    <script src="./frameworks/jquery.min.js"></script>
    <script src="frameworks/popper.min.js"></script>
    <script src="frameworks/bootstrap.js"></script>
    <script src="./includes/fa.js"></script>  
    <link rel="stylesheet" href="includes/main.css">
    <style>
        .card-img-top{
            height: 100px;
            width: 100px;
        /*    border-top-left-radius: 30px;
            border-bottom-right-radius: 30px;*/
            border-radius: 5%;
            padding: 0px;
            margin: 0px;
             box-shadow: 1px 1px 3px 1px grey;
        }
        .prod-title{
            padding: 5px;
            text-shadow: 1px 1px 3px 1px grey;
            font-size: 20px;
            color: #666666;
        }
        table{
            height: 130px; 
            width: 80%;
            padding-left: 0px;
        }
        .details-btn{
            width: 100%;
        }
        .prod-det{
            padding-left: 20px;
        }
        .fa-star{
            color: #FF9529;
        }
        .tile{
            color: black;
        }
        .tile:hover{
            text-decoration: none;
            color: black;          
        }
        .tag-boxes{
            padding: 10px;
        }
        .filter-btn{
            margin: 20px;
        }
        @media only screen and (max-width: 768px) {
             #product-menu {
            display: none;
         }
        }
        
        @media only screen and (min-width: 768px){
            #smaller-product-menu{
                display: none;
            }
        }
        .no-style-links{
            text-decoration: none;
            color: #333333;
        } .no-style-links:hover{
            text-decoration: none;
            color: #000000;
            font-size: 1.01em;
        }
        @media only screen and (min-width: 768px){
            .current-page{
                border-bottom: solid 1px #ffffff;
                font-size: 1.1em;
            }
        }
        @media only screen and (max-width: 786px){
            .current-page{
                font-size: 1.2rem;
                color: #090909!important;
            }
                
        }
        .carousel-indicators .active {
   background-color: #ffffff!important;
        }
.indicator{
  background-color: gray!important;
}

@media only screen and (min-width: 768px){
    .carousel-item img{
        height: 30vw;
    }
    .carousel-caption{
    background-image: linear-gradient(-90deg, #ffffff, #000000, #ffffff);
    opacity: 0.6;
    padding: 20px;
    color: #fff;
    text-align: center;
}
}
@media only screen and (max-width: 768px){
    .carousel-item img{
        height: 235.8px; /* 30 percent of 786px, for a smooth transition*/
        width: auto;
    }
    .carousel-caption{
    background-image: linear-gradient(-90deg, #ffffff, #000000, #ffffff);
    opacity: 0.6;
    padding: 10px;
    color: #fff;
    text-align: center;

}
}
.carousel{
  margin-left: 5vw;
  margin-right: 5vw;
  margin-top: 5vh;
}
.carousel-arrow{
    color: black;
    font-size: 1.2rem;
}

</style>