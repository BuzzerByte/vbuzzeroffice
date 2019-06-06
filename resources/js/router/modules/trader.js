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
      path: 'view-client',
      component: () => import('@/views/traders/clients'),
      name: 'Client',
      meta: { title: 'Client' },
    },
    {
      path: 'view-vendor',
      component: () => import('@/views/traders/vendors'),
      name: 'Vendor',
      meta: { title: 'Vendor' },
    },
  ],
};
export default traderRoutes;
