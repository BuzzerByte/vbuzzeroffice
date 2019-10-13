import request from '@/utils/request';
import Resource from '@/api/resource';

class VendorResource extends Resource {
  constructor() {
    super('vendors');
  }

  permissions(id) {
    return request({
      url: '/' + this.uri + '/' + id + '/permissions',
      method: 'get',
    });
  }

  updatePermission(id, permissions) {
    return request({
      url: '/' + this.uri + '/' + id + '/permissions',
      method: 'put',
      data: permissions,
    });
  }
}

export { VendorResource as default };
