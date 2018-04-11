import AdminComponent from '../components/admin/AdminComponent'
import DashboardComponent from '../components/admin/pages/dashboard/DashboardComponent'
import ChartsComponent from '../components/admin/pages/charts/ChartsComponent'
import LoginComponent from '../components/admin/pages/auth/LoginComponent'
import Products from '../components/admin/pages/products_modal/Products'
import Page404 from '../components/frontend/pages/404/Page404'
import SiteComponent from '../components/frontend/SiteComponent'
import HomePageComponent from '../components/frontend/pages/home/HomePageComponent'

export default [
    /**
     * Rotas Site
     */
    {
        path: '/',
        component: SiteComponent,
        meta: {auth: false},
        children: [
            {path: '', component: HomePageComponent, name: 'home'},
        ]
    },


    /**
     * Rotas Admin
     */
    {path: '/entrar', component: LoginComponent, name: 'auth'},
    {
        path: '/admin',
        component: AdminComponent,
        meta: {auth: true},
        children: [
            {path: '', component: DashboardComponent, name: 'dashboard'},
            {path: 'produtos', component: Products, name: 'products'},
            {path: 'graficos', component: ChartsComponent, name: 'charts'},
        ]
    },

    // Rota 404
    {path: '*', component: Page404},
]