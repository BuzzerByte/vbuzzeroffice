/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const errorRoutes = {
  path: '/error',
  component: Layout,
  redirect: 'noredirect',
  name: 'ErrorPages',
  meta: {
    title: 'errorPages',
    icon: '404',
  },
  children: [
    {
      path: '401',
<<<<<<< HEAD
      component: () => import('@/views/ErrorPage/401'),
=======
      component: () => import('@/views/error-page/401'),
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
      name: 'Page401',
      meta: { title: 'page401', noCache: true },
    },
    {
      path: '404',
<<<<<<< HEAD
      component: () => import('@/views/ErrorPage/404'),
=======
      component: () => import('@/views/error-page/404'),
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
      name: 'Page404',
      meta: { title: 'page404', noCache: true },
    },
  ],
};

export default errorRoutes;
