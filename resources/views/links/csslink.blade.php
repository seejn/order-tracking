 @section('csslink')
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
 <link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 <style>
    @media screen and (max-width: 992px){
        .sidebar{
            height: 0;
            opacity: 0;
            pointer-events: none;
        }
     }
     /* Adjust sidebar width as needed */
     html, body {
            height: 100vh;
            overflow: hidden;
        }
     .sidebar {
         background: #ddd;
         transition: 500ms;
     }
     .sidebar ul{
        flex-direction: column; 
     }
     .sidebar-active{
        height: 100%;
        opacity: 1;
        pointer-events: all;
     }

     
 </style>
 @endsection