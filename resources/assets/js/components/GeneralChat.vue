<template>
  <div class="container">
    <div class="row row-main equal-height-grid">
      <div class="col s12 m12 l12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">General Chat</span>
            <p>{{ listOfUsers }} Online</p>
          </div>
          <div class="divider"></div>
          <div class="card-content">
            <div class="chat-wrapper">
              <div id="chat">
                <div v-for="(message, key) in messages" class="chat-message" :class="{right: message.user_id == myId, coalesce: message.isCoalesce, bw: message.isBreakWord}" :title="message.ddate" :id="'chat' + (key + 1)" :data-user="message.user_id">
                  <img class="circle" :src="message.avatar" v-if="!message.isCoalesce" :alt="message.user">
                  {{ message.message }}
                </div>
              </div>
              <div class="typing" v-if="typing">{{ user }} is typing a message...</div>
            </div>
          </div>
          <div class="chat-input">
            <form id="chatForm">
              <div class="chat-input-bar">
                <textarea id="message" class="materialize-textarea" style="height: 72px;" v-model="messageBox" @keyup.enter="sendMessage"></textarea>
                <!-- EMOJI -->
                <!-- <button type="button" @click="sendMessage">
                  <i class="material-icons">mail</i>
                </button> -->
                <button type="button" @click="sendMessage">
                  <i class="material-icons">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        data() {
          return {
            myId: Laravel.user.id,
            user: Laravel.user.name,
            typing: false,
            messageBox: '',
            messages: [],
            listOfUsers: 0
          };
        },
        props: ['profileImage'],
        methods: {
          getMessage() {
            var vm = this;
            axios.post('/chat/get-general').then(res => {
              res.data.forEach(function (data, key) {
                var message = {
                  user_id: data.user_id,
                  user: data.user_name,
                  message: data.message,
                  ddate: moment(data.date).format('MMMM DD, YYYY HH:mm'),
                  avatar: data.avatar,
                  isCoalesce: data.isCoalesce,
                  isBreakWord: data.isBreakWord
                };
                vm.messages.push(message);
              });
            });
          },
          sendMessage() {
            var last_message = $('div.chat-message:last');
            var isCoalesce = false;
            var isBreakWord = false;
            if (typeof last_message.data() === 'undefined') {
              isCoalesce = false;
            } else {
              if (last_message.data().user == this.myId) {
                isCoalesce = true;
              } else {
                isCoalesce = false;
              }
            }

            if (this.messageBox.search(' ') == -1 && this.messageBox.length > 48) {
              isBreakWord = true;
            } else {
              isBreakWord = false;
            }
            var message = {
              user_id: Laravel.user.id,
              user: Laravel.user.name,
              message: this.messageBox,
              sdate: moment().format('YYYY-MM-DD HH:mm:ss'), // saved date
              ddate: moment().format('MMMM DD, YYYY HH:mm'), // displayed date
              avatar: this.profileImage,
              isCoalesce: isCoalesce,
              isBreakWord: isBreakWord
            };

            this.messages.push(message);

            axios.post('/chat/send-general', message).then(res => {
              if (ps.reach.y == "start" || ps.reach.y == "end") {
                this.scrollToLast();
              }
            });

            this.messageBox = '';
            $('#chatForm').reset();
          },
          scrollToLast() {
            $('.chat-wrapper').scrollTop($('.chat-wrapper').prop('scrollHeight'));
          }
        },
        mounted() {
            this.getMessage();
            Echo.join('general-chat-channel')
                .here((users) => {
                  this.listOfUsers = users.length;
                  if (this.messages.length == 0) {
                    $('#chat').prepend(`<div class="joining">${ this.user } joining the chatroom</div>`);
                  }
                })
                .joining((user) => {
                  this.listOfUsers += 1;
                  if (this.messages.length == 0) {
                    $('#chat').append(`<div class="joining">${ user.name } joining the chatroom</div>`);
                  } else {
                    $('#chat').append(`<div class="joining">${ user.name } joining the chatroom</div>`);
                  }
                  if (ps.reach.y == "start" || ps.reach.y == "end") {
                    this.scrollToLast();
                  }
                })
                .leaving((user) => {
                  this.listOfUsers -= 1;
                  if (this.messages.length == 0) {
                    $('#chat').append(`<div class="joining">${ user.name } leaving the chatroom</div>`);
                  } else {
                    $('#chat').append(`<div class="joining">${ user.name } leaving the chatroom</div>`);
                  }
                  if (ps.reach.y == "start" || ps.reach.y == "end") {
                    this.scrollToLast();
                  }
                })
                .listen('GeneralChatEvent', (e) => {
                  var message = {
                    user_id: e.chat.user_id,
                    user: e.chat.user,
                    message: e.chat.message,
                    sdate: e.chat.sdate,
                    ddate: e.chat.ddate,
                    avatar: e.chat.avatar,
                    isCoalesce: e.chat.isCoalesce,
                    isBreakWord: e.chat.isBreakWord
                  };
                  this.messages.push(message);
                  if (ps.reach.y == "start" || ps.reach.y == "end") {
                    this.scrollToLast();
                  }
                })
            Echo.private('general-chat-channel')
                .listenForWhisper('typing', (e) => {
                  this.user = e.name;
                  if (e.name != '') {
                    this.typing = true;
                  } else {
                    this.typing = false;
                  }
                  if (ps.reach.y == "start" || ps.reach.y == "end") {
                    this.scrollToLast();
                  }
                });
        },
        watch: {
          messageBox: function(data) {
            Echo.private('general-chat-channel')
                .whisper('typing', {
                  typing: true,
                  name: Laravel.user.name
                });
            setTimeout(function () {
              Echo.private('general-chat-channel')
                  .whisper('typing', {
                    typing: false,
                    name: ''
                  });
            }, 500);
          }
        }
    }
</script>

<style media="screen">
  .ps__rail-x,
  .ps__rail-y {
    opacity: 0.6;
  }
</style>
