import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent';
import ContactsCreate from './views/ContactsCreate';
import ContactsShow from './views/ContactsShow';
import ContactsEdit from './views/ContactsEdit';




Vue.use(VueRouter);

export default new VueRouter({

    routes: [

        //use : to represent variable/wildcard
        
        { path: '/', component: ExampleComponent },
        { path: '/contacts/create', component: ContactsCreate },
        { path: '/contacts/:id', component: ContactsShow },
        { path: '/contacts/:id/edit', component: ContactsEdit }



    
    ],
    mode: 'history'
});