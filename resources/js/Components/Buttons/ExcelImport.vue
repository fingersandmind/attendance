<template>
  <div class="max-w-md p-6 mt-8 ml-auto border border-gray-300 rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold text-center">Upload Attendance Excel</h2>
    <input
      type="file"
      @change="handleFileUpload"
      class="w-full p-2 mb-4 text-gray-700 border border-gray-300 rounded-md"
    />
    <p v-if="fileName" class="mb-4 text-gray-600">Selected file: {{ fileName }}</p>
    <button
      @click="submitFile"
      class="w-full py-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600"
    >
      Upload
    </button>
    <p v-if="uploadStatus" class="mt-4 text-center" :class="{'text-red-500' : !statusApprove, 'text-green-600': statusApprove}">{{ uploadStatus }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const file = ref(null)
const fileName = ref('')
const uploadStatus = ref('')
const statusApprove = ref(false);

const handleFileUpload = (event) => {
  const selectedFile = event.target.files[0]
  if (selectedFile) {
    if (selectedFile.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || selectedFile.type === 'application/vnd.ms-excel') {
      file.value = selectedFile
      fileName.value = selectedFile.name
      uploadStatus.value = ''
    } else {
      toast.error('Please select a valid Excel file (.xlsx or .xls)')
      file.value = null
      fileName.value = ''
    }
  }
}

const submitFile = async () => {
  if (file.value) {
    const formData = new FormData()
    formData.append('file', file.value)

    try {
      const response = await axios.post('/admin/import-excel', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      })
      uploadStatus.value = 'File uploaded and data processed successfully'
      statusApprove.value = true;
      toast.success('File uploaded successfully')
    } catch (error) {
      uploadStatus.value = 'Error uploading file'
      statusApprove.value = false;
      toast.error('Error uploading file')
    }
  } else {
    uploadStatus.value = 'No file selected'
  }
}
</script>

<style scoped>
/* Scoped styles for component-specific styling */
</style>
