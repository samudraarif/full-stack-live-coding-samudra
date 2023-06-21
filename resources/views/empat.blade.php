<!DOCTYPE html>
<html>
<head>
    <title>Empat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="pl-5 pr-5">
    <h2>Create Member Account</h2>
    <form id="create-member-form" class="pb-5">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
        <br>
        <button type="submit">Submit</button>
    </form>

    <h2>Data Member</h2>
    <table id="member-table" class="table">
        <thead>
            <tr>
                <th>Member Code</th>
                <th>Name</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        $(document).ready(function() {
            // Submit form using Ajax
            $('#create-member-form').submit(function(e) {
                e.preventDefault();

                var name = $('#name').val();
                var password = $('#password').val();

                $.ajax({
                    url: '/empat-simpan',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        password: password
                    },
                    success: function(response) {
                        alert(response.message);
                        loadMemberList(); // Refresh the member list
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            });

            // Load member list via Ajax
            function loadMemberList() {
                $.ajax({
                    url: '/empat',
                    method: 'GET',
                    success: function(response) {
                        var memberList = {!! $member !!};
                        var html = '';

                        for (var i = 0; i < memberList.length; i++) {
                            var createdDate = new Date(memberList[i].created_date);
                            var options = {day: 'numeric',month: 'long', year: 'numeric'  };
                            formattedDate = createdDate.toLocaleDateString("en-GB", options)
                            html += '<tr>';
                            html += '<td>' + memberList[i].member_code + '</td>';
                            html += '<td>' + memberList[i].name + '</td>';
                            html += '<td>' + formattedDate + '</td>';
                            html += '</tr>';
                        }

                        $('#member-table tbody').html(html);
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            }

            loadMemberList(); // Load member list on page load
        });
    </script>
</body>
</html>