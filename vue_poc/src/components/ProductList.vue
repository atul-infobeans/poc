

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      loading: true,
      error: null
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('http://localhost:8000/api/products');
        this.products = response.data;
      } catch (err) {
        this.error = 'Failed to load products';
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>

<style scoped>
.product-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.product {
  border: 1px solid #ddd;
  padding: 15px;
  width: 200px;
}

.product img {
  max-width: 100%;
}

.loading {
  color: blue;
}

.error {
  color: red;
}

.no-products {
  color: gray;
}
</style>

<!-- src/components/ProductList.vue -->
<template>
  <div class="product-list">
    <h1>Products</h1>
    <div v-if="loading" class="loading">Loading...</div>
    <div v-if="error" class="error">{{ error }}</div>
    <div v-if="products.length === 0" class="no-products">No products found</div>
    <div v-for="product in products"  class="product-list">
        <div v-for="item_val in product" :key="item_val.id" class="product">
            <h2>{{ item_val.title}}</h2>
            <h2>{{ item_val.total}}</h2>
            <p>{{ item_val.description }}</p>
            <p><strong>${{ item_val.price }}</strong></p>
            <div v-for="image in item_val.images" class="product new">
                <img :src="image" alt="Product image" />
            </div>
        </div>
    </div>
  </div>
</template>