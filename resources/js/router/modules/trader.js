import Layout from '@/layout';

const traderRoutes = {
  path: '/trader',
  component: Layout,
  redirect: '/trader/client',
  name: 'trader',
  meta: {
    title: 'Trader',
    icon: 'peoples',
    permissions: ['view menu table'],
  },
  children: [
    {
      path: 'clients/edit/:id(\\d+)',
      component: () => import('@/views/traders/clients/Show'),
      name: 'ClientProfile',
      meta: { title: 'clientProfile', noCache: true, permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'clients',
      component: () => import('@/views/traders/clients'),
      name: 'Client',
      meta: { title: 'Client' },
    },
    {
      path: 'vendors',
      component: () => import('@/views/traders/vendors'),
      name: 'Vendor',
      meta: { title: 'Vendor' },
    },
  ],
};
export default traderRoutes;
