<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Satu</title>
  </head>

<table class="table" id="myTable">
    <thead>
      <tr>
        <th>Number</th>
        <th>Name</th>
        <th>Age</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       var data = {!! $data !!};

        $.each(data, function(index, obj) {
        var row = $('<tr>');
         $('<td>').text(index + 1).appendTo(row); 
        $('<td>').text(obj.name).appendTo(row);
        $('<td>').text(obj.age).appendTo(row);
        row.appendTo('#myTable tbody');
        });
</script>