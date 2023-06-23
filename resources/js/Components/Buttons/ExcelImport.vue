<template>
    <div>
      <form @submit.prevent="importExcel" enctype="multipart/form-data">
        <span class="inline-flex rounded-md shadow-sm isolate">
          <button type="button" 
            onclick="document.getElementById('file').click();"
            class="relative inline-flex items-center gap-x-1.5 rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
            </svg>
            Select File
          </button>
          <input type="file" id="file" ref="fileInput" accept=".xls,.xlsx" required class="hidden"/>
          <button type="submit" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-semibold text-white bg-blue-400 rounded-r-md ring-1 ring-inset ring-blue-300 hover:bg-blue-500 focus:z-10">Import</button>
        </span>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
    setup() {
      const fileInput = ref(null);
  
      const importExcel = (event) => {
        const formData = new FormData();
        formData.append('file', fileInput.value.files[0]);
  
        axios
          .post('/admin/import-excel', formData)
          .then((response) => {
            console.log(response.data.message);
            // Handle the success message
            alert(response.data.message);
          })
          .catch((error) => {
            console.log(error.response.data.message);
            // Handle the error message
          });
      };
  
      return {
        fileInput,
        importExcel,
      };
    },
  };
  </script>
  