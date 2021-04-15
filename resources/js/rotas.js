import cons_usuario from './viewsVue/cons_usuario';
import cons_chamado from './viewsVue/cons_chamado';
import cad_chamado from './viewsVue/cad_chamado';
import NaoEncontrado from './viewsVue/NaoEncontrado.vue';


export default {
    mode: 'history',
    routes: [
        {
            path: '*',
            component: NaoEncontrado
        },/* 
        {
            path: '/',
            component: ""
        }, */
        {
            path: '/cons_usuario',
            component: cons_usuario,
            name: "cons_usuario"
        },
        {
            path: '/cons_chamado',
            component: cons_chamado,
            name: "cons_chamado"
        },
        {
            path: '/cad_chamado',
            component: cad_chamado,
            name: "cad_chamado"
        }

    ]
}