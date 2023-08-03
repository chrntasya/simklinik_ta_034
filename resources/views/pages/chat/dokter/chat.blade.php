@extends('layouts/header_dokter')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->  
      
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body" >
                        <section class="content">
                            <div class="container-fluid">
                                <h4 class="mt-4 mb-2">Direct Chat</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- DIRECT CHAT PRIMARY -->
                                        <div class="card card-primary card-outline direct-chat direct-chat-primary" style="height: 500px">                                           

                                            <div class="card-body" >

                                                <div class="direct-chat-messages" style="height: 500px" id="listchat">
                                                </div>



                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                              
                                                    <div class="input-group">
                                                        <input type="text" name="message" id="message" placeholder="Type Message ..."
                                                            class="form-control" >
                                                        <span class="input-group-append">
                                                            <button type="button"  class="btn btn-primary" id="buttonclick"  onclick="addChat()">Send</button>
                                                        </span>
                                                    </div>
                                                
                                            </div>
                                            <!-- /.card-footer-->
                                        </div>
                                        <!--/.direct-chat -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.7/dayjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.7/plugin/customParseFormat.min.js"></script>
    <script>
        let id = {{ $id }}
        let user_id = {{ auth()->user()->id }}
        let resChat = null;
        const listChat = document.getElementById('listchat');
        let count = 0;

        $(document).ready(function() {
            getChat();

        })

        setInterval(function(){
            getChat() // this will run after every 5 seconds
        }, 2000);
        

        function getChat() {
            $.ajax({
                type: 'POST',
                url: '{{ route('pasien.chat.getchat') }}',
                dataType: 'html',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id_transasction': id
                },
                success: function(data) {
                    res = JSON.parse("[" + data + "]");
                    resChat = res[0].data;
                    count = 0;

                    console.log(resChat);
                    listChat.innerHTML = resChat.map(loadChat).join('');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function loadChat(data) {    
          const tanggal = dayjs(data.created_at, "yyyy-MM-dd HH:mm:ss").format('MM/DD/YYYY h:mm a');
          
            if (data.sender_id == user_id) {
              if (count !== 0 && data.sender_id == resChat[count - 1].sender_id) {
                count = count+1;
                return `
                        <div class="direct-chat-msg right ">                                               
                            <div class="direct-chat-text text-right">
                                ${data.message}
                            </div>                                                                                    
                        </div>             
                    `;
                 
              }else{
                count = count+1;
                return `
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right">${data.sender.username}</span>
                          <span class="direct-chat-timestamp float-left">${tanggal}</span>
                        </div>
                        
                        <img class="direct-chat-img" src="{{ asset('icon/doktercowo.png') }}" alt="Message User Image">
                        
                        <div class="direct-chat-text text-right">
                          ${data.message}
                        </div>                                                                                    
                    </div>             
                `;
              }
               
            }else{     
              if (count !== 0 && data.sender_id == resChat[count - 1].sender_id) {

                count = count+1;
                return  `
                    <div class="direct-chat-msg">                    
                        <div class="direct-chat-text">
                          ${data.message}
                        </div>
                    </div>
                `;
                  
              }else{
                count = count+1;
                  return  `
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">${data.sender.username}</span>
                            <span class="direct-chat-timestamp float-right">
                              ${tanggal}
                            </span>
                        </div>

                        <img class="direct-chat-img"
                            src="{{ asset('icon/doktercowo.png') }}"
                            alt="Message User Image">

                        <div class="direct-chat-text">
                          ${data.message}
                        </div>

                    </div>
                `;
              }
           
            }
        }

        function formatDate(date) {
          var hours = date.getHours();
          var minutes = date.getMinutes();
          var ampm = hours >= 12 ? 'pm' : 'am';
          hours = hours % 12;
          hours = hours ? hours : 12; // the hour '0' should be '12'
          minutes = minutes < 10 ? '0'+minutes : minutes;
          var strTime = hours + ':' + minutes + ' ' + ampm;
          return (date.getMonth()+1) + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
        }

        $("#message").keyup(function(event) {
          if (event.keyCode === 13) {
              $("#buttonclick").click();
          }
      });



        function addChat() {
            var message = document.getElementById('message').value;
            let sender_id = {{auth()->user()->id}};
            let receiver = {{$transaksi->dokter_id}};

            $.ajax({
                  type: 'POST',
                  url: '{{ route('pasien.chat.addchat') }}',
                  dataType: 'html',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: {
                      "_token": "{{ csrf_token() }}",
                      'id_transasction': id,
                      'message' : message,
                      'sender' : sender_id,
                      'receiver' : receiver
                  },
                  success: function(data) {
                    $('#message').val('');
                    getChat();
                   
                  },
                  error: function(data) {
                      console.log(data);
                  }
              });
        }
    </script>
@endsection
