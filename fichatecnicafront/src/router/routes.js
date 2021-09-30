
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') },
      { path: 'MostrarRegistro', component: () => import('pages/MostrarRegistro.vue') },
      { path: 'Salida', component: () => import('pages/Salida.vue') },
      { path: 'Usuarios', component: () => import('pages/Usuarios.vue') },
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
