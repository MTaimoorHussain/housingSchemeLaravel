<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Housing Scheme</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href={{asset("public/adminlte/plugins/fontawesome-free/css/all.min.css")}}>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href={{asset("public/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
  <!-- adminlte style -->
  <link rel="stylesheet" href={{asset("public/adminlte/dist/css/adminlte.min.css")}}>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    .modal-header{
      background: #008000;
      color: white;
    }
    #label {
      position: absolute;
      top: 10px;
      left: 13px;
      width: 100%;
      color: #d3d3d3;
      transition: 0.2s all;
      cursor: text;
    }
    .input {
      width: 100%;
      border: 0;
      outline: 0;
      padding: 0.5rem 0;
      border-bottom: 2px solid #d3d3d3;
      box-shadow: none;
      color: #111;
    }
    .input:invalid {
      outline: 0;
      // color: #ff2300;
      //   border-color: #ff2300;
    }
    .input:focus,
    .input:valid {
      border-color: #00dd22;
    }
    .input:focus~#label,
    .input:valid~#label {
      font-size: 14px;
      top: -14px;
      left: 4px;
      color: #00dd22;
    }
    .addButton{
      margin-top:7%;
    }
    .CarryInput{
     margin-top: 4%;
   }
   .paginate_button{
    background: #28a745;
    color: white;
    color: white !important;
  }
</style>
</head>