<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactsList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
    export default {
        // props: {
        //     user: {
        //         type: Object,
        //         required: true
        //     }
        // },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
                user:null
            };
        },
        mounted() {
            this.user=this.currentUser;
            console.log(this.currentUser.id);
         
         Echo.private(`messages.${this.currentUser.id}`)
                .listen('NewMessage', (e) => {
                   console.log("Message Recieved")
                    this.hanleIncoming(e.message);
                });



            axios.get('/api/contacts')
                .then((response) => {
                   
                    this.contacts = response.data;
                });




        },
        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);
                axios.get(`/api/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }
                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;
                    return single;
                })
            }
        },
         computed: {
           currentUser() {
                return this.$store.getters.currentUser
            }
        },
        components: {Conversation, ContactsList}
    }
</script>


<style lang="scss" scoped>
.chat-app {
    display: flex;
}
</style>