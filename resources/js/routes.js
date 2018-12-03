import Home from './components/Home'
import Fields from './components/Fields'
import FieldCreate from "./components/FieldCreate";
import FieldEdit from './components/FieldEdit'
import Subscribers from './components/Subscribers'
import SubscriberCreate from './components/SubscriberCreate'
import SubscriberEdit from './components/SubscriberEdit'

const routes = [
    {path: '/', component: Home, name: "home"},
    {path: '/fields', component: Fields, name: 'fields'},
    {path: '/fields/create', component: FieldCreate, name: 'field-create'},
    {path: '/fields/:field/edit', component: FieldEdit, name: 'field-edit'},
    {path: '/subscribers', component: Subscribers, name: 'subscribers'},
    {path: '/subscribers/create', component: SubscriberCreate, name: 'subscriber-create'},
    {path: '/subscribers/:subscriber/edit', component: SubscriberEdit, name: 'subscriber-edit'},
];

export default routes;