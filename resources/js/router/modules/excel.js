/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const excelRoutes = {
  path: '/excel',
  component: Layout,
  redirect: '/excel/export-excel',
  name: 'Excel',
  meta: {
    title: 'excel',
    icon: 'excel',
    permissions: ['view menu excel'],
  },
  children: [
    {
      path: 'export-excel',
      component: () => import('@/views/excel/ExportExcel'),
<<<<<<< HEAD
      name: 'ExportExcel',
=======
      name: 'exportExcel',
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
      meta: { title: 'exportExcel' },
    },
    {
      path: 'export-selected-excel',
      component: () => import('@/views/excel/SelectExcel'),
      name: 'SelectExcel',
      meta: { title: 'selectExcel' },
    },
    {
      path: 'export-merge-header',
      component: () => import('@/views/excel/MergeHeader'),
      name: 'MergeHeader',
      meta: { title: 'mergeHeader' },
    },
    {
      path: 'upload-excel',
      component: () => import('@/views/excel/UploadExcel'),
      name: 'UploadExcel',
      meta: { title: 'uploadExcel' },
    },
  ],
};

export default excelRoutes;
