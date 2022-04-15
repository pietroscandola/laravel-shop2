<template>
  <div class="col-4 py-3">
    <div class="card" style="width: 18rem">
      <img :src="product.image" class="card-img-top" :alt="product.name" />
      <div class="card-body">
        <h5 class="card-title">{{ product.name }}</h5>
        <p class="card-text">
          {{ product.description }}
        </p>
        <p class="card-text text-muted">{{ product.price }}€</p>
      </div>
      <div
        class="card-footer d-flex justify-content-between align-items-center"
      >
        <h5 v-if="product.brand">
          <span :class="`badge badge-pill badge-${product.brand.color}`">{{
            product.brand.name
          }}</span>
        </h5>
        <div class="d-flex justify-content-between align-items-center">
          <i
            role="button"
            class="fa-solid fa-circle-minus fa-lg text-danger"
            @click="removeProductToCartArray(product.id)"
          ></i>
          <button
            class="btn mx-1"
            :class="[cart.quantity > 0 ? 'btn-success' : 'btn-primary']"
            @click.once="addProductToCartArray(product.id)"
          >
            <i v-if="cart.quantity > 0" class="fa-solid fa-cart-arrow-down"></i>
            <i v-else class="fa-solid fa-cart-plus"></i>
          </button>
          <i
            role="button"
            class="fa-solid fa-circle-plus fa-lg text-success"
          ></i>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: ["product"],
  data() {
    return {
      cart: {},
    };
  },
  methods: {
    addProductToCartArray(id) {
      this.cart = { product_id: id, inCart: true, quantity: 1 };
      this.$emit("on-product-in-cart", this.cart);
    },
    removeProductToCartArray(id) {
      const index = this.cart.indexOf(id);
      if (index >= 0) {
        this.cart.splice(index, 1); // 2nd parameter means remove one item only
      }
    },
  },
};
</script>

<style>
</style>