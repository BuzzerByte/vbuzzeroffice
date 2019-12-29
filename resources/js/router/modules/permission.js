import Layout from '@/layout';

const permissionRoutes = {
  path: '/permission',
  component: Layout,
  redirect: '/permission/index',
  alwaysShow: true, // will always show the root menu
  meta: {
    title: 'permission',
    icon: 'lock',
    permissions: ['view menu permission'],
  },
  children: [
    {
      path: 'page',
      component: () => import('@/views/permission/Page'),
      name: 'PagePermission',
      meta: {
        title: 'pagePermission',
        permissions: ['manage permission'],
      },
    },
    {
      path: 'directive',
      component: () => import('@/views/permission/Directive'),
<<<<<<< HEAD
      name: 'DirectivePermission',
=======
      name: 'directivePermission',
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
      meta: {
        title: 'directivePermission',
        // if do not set roles neither permissions, means: this page does not require permission
      },
    },
  ],
};

export default permissionRoutes;
