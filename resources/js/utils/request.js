<<<<<<< HEAD
import axios from 'axios';
import { Message } from 'element-ui';
import { getToken, setToken } from '@/utils/auth';

// Create axios instance
const service = axios.create({
=======
import '@/bootstrap';
import { Message } from 'element-ui';
// import { isLogged, setLogged } from '@/utils/auth';

// Create axios instance
const service = window.axios.create({
>>>>>>> 9d5fdcc792bc698dd171b1856cea47fe27fd55e8
  baseURL: process.env.MIX_BASE_API,
  timeout: 10000, // Request timeout
});

// Request intercepter
service.interceptors.request.use(
  config => {
<<<<<<< HEAD
    const token = getToken();
    if (token) {
      config.headers['Authorization'] = 'Bearer ' + getToken(); // Set JWT token
    }

=======
    // const token = isLogged();
    // if (token) {
    //   config.headers['Authorization'] = 'Bearer ' + isLogged(); // Set JWT token
    // }
>>>>>>> 9d5fdcc792bc698dd171b1856cea47fe27fd55e8
    return config;
  },
  error => {
    // Do something with request error
    console.log(error); // for debug
    Promise.reject(error);
  }
);

// response pre-processing
service.interceptors.response.use(
  response => {
<<<<<<< HEAD
    if (response.headers.authorization) {
      setToken(response.headers.authorization);
      response.data.token = response.headers.authorization;
    }
=======
    // if (response.headers.authorization) {
    //   setLogged(response.headers.authorization);
    //   response.data.token = response.headers.authorization;
    // }
>>>>>>> 9d5fdcc792bc698dd171b1856cea47fe27fd55e8

    return response.data;
  },
  error => {
    let message = error.message;
    if (error.response.data && error.response.data.errors) {
      message = error.response.data.errors;
    } else if (error.response.data && error.response.data.error) {
      message = error.response.data.error;
    }

    Message({
      message: message,
      type: 'error',
      duration: 5 * 1000,
    });
    return Promise.reject(error);
<<<<<<< HEAD
  },
=======
  }
>>>>>>> 9d5fdcc792bc698dd171b1856cea47fe27fd55e8
);

export default service;
