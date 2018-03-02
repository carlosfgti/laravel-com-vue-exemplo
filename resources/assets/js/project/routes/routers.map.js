import AdminComponent from '../components/admin/AdminComponent'
import DashboardComponent from '../components/admin/pages/dashboard/DashboardComponent'
import ProductComponent from '../components/admin/pages/products/ProductComponent'
import LoginComponent from '../components/admin/pages/auth/LoginComponent'
import ProductAddComponent from '../components/admin/pages/products/ProductAddComponent'
import ProductEditComponent from '../components/admin/pages/products/ProductEditComponent'
import ProductsListComponent from '../components/admin/pages/products/ProductsListComponent'
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
            {
                path: 'produtos',
                component: ProductComponent,
                children: [
                    {path: '', component: ProductsListComponent, name: 'products'},
                    {path: 'adicionar', component: ProductAddComponent, name: 'product.add'},
                    {path: 'editar/:id', component: ProductEditComponent, name: 'product.edit', props: true},
                ]
            },
        ]
    },

    // Rota 404
    {path: '*', component: Page404},
]