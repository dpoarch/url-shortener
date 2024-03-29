<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>URL Shortener</title>
  </head>
  <body>





  <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">URL Shortener</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Analytics</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>


    <div class="container-fluid">
        <div class="row">
            <div style="display: block; height: 50px; position: relative;"></div>
        </div>

        <div class="row">
            <div class="col-sm">


                <div class="card">
                    <div class="card-header">
                        Generate New Short URL
                    </div>
                    <div class="card-body">

                    <div id="msg_success" class="alert alert-success" role="alert" style="display: none;">
                        Successfully Created a new Short URL for www.google.com
                    </div>

                        <form id="frm_urlcreate">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter URL</label>
                                <input type="text" class="form-control" id="txt_url" aria-describedby="URL" placeholder="Enter URL">
                                <small id="emailHelp" class="form-text text-muted">Enter the URL you want to shrink</small>
                            </div>
                            <button type="button" id="btn_submit" class="btn btn-primary">Generate Short URL</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                    <div class="card">
                            <div class="card-header">
                                Analytics
                            </div>
                            <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Short URL</th>
                                    <th scope="col">Clicks</th>
                                    <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="grd_data">
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>

        $(document).on('click', '#btn_submit', function(){

            let valid_url = check_url($('#txt_url').val());
            if(valid_url){
                send_data();
            }
            else
            {
                alert('Please enter a valid url');
            }
            

        });

        function send_data(){

            $.ajax({
                    type: 'POST',
                    url: '/index.php/url/create',
                    data: {url: $('#txt_url').val()},
                    dataType: 'json',
                    success: function(data){
                                 console.log(data);
                                 load_data();
                                 generate_message(data);
                                 $('#frm_urlcreate').hide();
                             }
                            
                    });
        }

        function generate_message(data){
            let html = '';

            html += 'Successfully Created a new Short URL for ' + data.url;
            html += '<br />'
            html += '<br />'
            html += '<br />'
            html += '<strong>URL : </strong>' + data.url;
            html += '<br />'
            html += '<strong>Short URL : </strong>' + `<a href="http://localhost/index.php/url/load/${data.shorturl}">http://localhost/index.php/url/load/` + data.shorturl + '</a>';
            html += '<br />'
            html += '<br />'

            $('#msg_success').html(html);
            $('#msg_success').show();

        }

        function load_data(){
            $.ajax({
                    type: 'GET',
                    url: '/index.php/url/analytics',
                    dataType: 'json',
                    success: function(data){

                         console.log(data);
                         let j = data;
                         
                         let html = '';
                         for(let i = 0; i <= data.length -1; i++)
                         {

                            html += '<tr>';
                            html += '    <td scope="row">'+ data[i].id +'</td>';
                            html += '    <td>'+ data[i].shorturl +'</td>';
                            html += '    <td>'+ data[i].clicks +'</td>';
                            html += '    <td>'+ data[i].datecreated +'</td>';
                            html += '</tr>';

                         }

                         $('#grd_data').html(html);
                        }   
                    });
        }

        function check_url(str)
        {
        regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
                if (regexp.test(str))
                {
                return true;
                }
                else
                {
                return false;
                }
        }


    </script>
  </body>
</html>