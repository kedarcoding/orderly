<template>
  <div class="p-4">
    <h2 class="text-xl font-bold mb-4">Orders</h2>

    <!-- Create Order -->
    <div class="mb-6 border p-4">
      <h3 class="font-semibold mb-2">Create New Order</h3>
      <input v-model="newOrder.user_id" placeholder="User ID" class="border p-1 mr-2" />
      <input v-model="newOrder.item_name" placeholder="Item Name" class="border p-1 mr-2" />
      <input v-model="newOrder.price" placeholder="Price" type="number" class="border p-1 mr-2" />
      <button @click="createOrder" class="bg-blue-500 text-white px-3 py-1">Create</button>
    </div>

    <div v-if="successMessage" class="text-green-600 font-semibold mb-2">{{ successMessage }}</div>
    <div v-if="errorMessage" class="text-red-600 font-semibold mb-2">{{ errorMessage }}</div>
    
    <table class="table-auto w-full border">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2 border">Order ID</th>
          <th class="p-2 border">User</th>
          <th class="p-2 border">User ID</th>
          <th class="p-2 border">Item</th>
          <th class="p-2 border">Price</th>
          <th class="p-2 border">Created At</th>
          <th class="p-2 border">Status</th>
          
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.id">
          <td class="border p-1">{{ order.id }}</td>
          <td class="border p-1">{{ order.user?.name }}</td>
          <td class="border p-1">{{order.user?.id}}</td>
          <td class="border p-1">{{ order.item_name }}</td>
          <td class="border p-1">{{ order.price }}</td>
           <td class="border p-1">{{ formatDate(order.created_at) }}</td>
          <td class="border p-1 flex justify-center items-center">
            <div class="flex items-center ">
              <select
                v-model="order.status"
                @change="updateStatus(order)"
                :disabled="loadingId === order.id"
               class="border p-1 mr-2 text-white rounded"
                :class="{
                'bg-yellow-500': order.status === 'pending',
                'bg-green-600': order.status === 'paid',
                'bg-red-600': order.status === 'cancelled'
                }"
              >
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="cancelled">Cancelled</option>
              </select>
              <span v-if="loadingId === order.id" class="text-sm text-gray-500">Saving...</span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4 flex gap-2">
      <button
        @click="changePage(pagination.current_page - 1)"
        :disabled="!pagination.prev_page_url"
        class="bg-gray-300 px-3 py-1 rounded"
      >
        Prev
      </button>

      <span class="px-2 py-1">Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>

      <button
        @click="changePage(pagination.current_page + 1)"
        :disabled="!pagination.next_page_url"
        class="bg-gray-300 px-3 py-1 rounded"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const orders = ref([])
const pagination = ref({})
const page = ref(1)
const loadingId = ref(null)

const successMessage = ref('')
const errorMessage = ref('')

const newOrder = ref({
  user_id: '',
  item_name: '',
  price: '',
  status: 'pending'
})

const fetchOrders = async () => {
  const res = await fetch(`http://localhost:8000/api/orders?page=${page.value}`)
  const data = await res.json()
  orders.value = data.data
  pagination.value = {
    current_page: data.current_page,
    last_page: data.last_page,
    prev_page_url: data.prev_page_url,
    next_page_url: data.next_page_url
  }
}

const changePage = async (newPage) => {
  page.value = newPage
  await fetchOrders()
}

const createOrder = async () => {
    successMessage.value = ''
    errorMessage.value = ''
   try {
    const res = await fetch('http://localhost:8000/api/orders', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(newOrder.value)
    })

    if (!res.ok) {
      const errorData = await res.json()
      throw new Error(errorData.message || 'Something went wrong')
    }
    await fetchOrders()
    newOrder.value = { user_id: '', item_name: '', price: '', status: 'pending' }
    showSuccessMessage('Order created successfully!')
  } catch (err) {
    showErrorMessage(err.message)
  }
}

const updateStatus = async (order) => {
  loadingId.value = order.id
  await fetch(`http://localhost:8000/api/orders/${order.id}`, {
    method: 'PATCH',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ status: order.status })
  })
  loadingId.value = null
  showSuccessMessage('Order status updated!')
}


function showSuccessMessage(text) {
  successMessage.value = text
  setTimeout(() => {
    successMessage.value = ''
  }, 3000)
}

function showErrorMessage(text) {
  errorMessage.value = text
  setTimeout(() => {
    errorMessage.value = ''
  }, 3000)
}

function formatDate(datetime) {
  return new Date(datetime).toLocaleString();
}
onMounted(fetchOrders)
</script>
