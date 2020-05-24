import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent';
import ContactsCreate from './views/ContactsCreate';
import ContactsShow from './views/ContactsShow';
import ContactsEdit from './views/ContactsEdit';
import ContactsIndex from './views/ContactsIndex';
import BirthdaysIndex from './views/BirthdaysIndex';






Vue.use(VueRouter);

export default new VueRouter({

    routes: [

        //use : to represent variable/wildcard
        
        { path: '/', component: ExampleComponent },
        { path: '/contacts/create', component: ContactsCreate },
        { path: '/contacts', component: ContactsIndex },
        { path: '/contacts/:id', component: ContactsShow },
        { path: '/contacts/:id/edit', component: ContactsEdit },

        // birthday

        { path: '/birthdays', component: BirthdaysIndex }




    
    ],
    mode: 'history'
});