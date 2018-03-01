import HomeComponent from '../components/pages/home/HomeComponent'
import ProductComponent from '../components/pages/products/ProductComponent'
import LoginComponent from '../components/pages/auth/LoginComponent'
import ProductAddComponent from '../components/pages/products/ProductAddComponent'
import ProductEditComponent from '../components/pages/products/ProductEditComponent'
import ProductsListComponent from '../components/pages/products/ProductsListComponent'
import Page404 from '../components/pages/404/Page404'

export default [
    {path: '/', component: HomeComponent, name: 'home'},
    {path: '/entrar', component: LoginComponent, name: 'auth'},
    {
        path: '/produtos',
        component: ProductComponent,
        meta: {auth: true},
        children: [
            {path: '', component: ProductsListComponent, name: 'products'},
            {path: 'adicionar', component: ProductAddComponent, name: 'product.add'},
            {path: 'editar/:id', component: ProductEditComponent, name: 'product.edit', props: true},
        ]
    },
    {path: '*', component: Page404},
]