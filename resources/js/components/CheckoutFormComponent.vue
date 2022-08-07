<template>
  <form @submit.prevent="handleFormSubmit">
    <div class="row">
      <div class="col-lg-6 col-12">
        <div
          v-if="state.validation.message"
          class="
            alert alert-danger alert-dismissible
            fade
            show
            error
            text-center
          "
          role="alert"
        >
          {{ state.validation.message }}
          <button
            type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="checkbox-form">
          <h3>Billing Details</h3>
          <div class="row">
            <div class="col-md-6">
              <div class="checkout-form-list">
                <label for="first_name"
                  >First Name <span class="required">*</span></label
                >
                <input
                  type="text"
                  name="first_name"
                  id="first_name"
                  placeholder="Enter you first name"
                  v-model="state.form.first_name"
                />
                <small
                  v-if="
                    state.validation.errors &&
                    state.validation.errors.first_name
                  "
                  class="text-danger"
                >
                  {{ state.validation.errors.first_name[0] }}
                </small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="checkout-form-list">
                <label for="last_name"
                  >Last Name <span class="required">*</span></label
                >
                <input
                  type="text"
                  name="last_name"
                  id="last_name"
                  placeholder="Enter your last name"
                  v-model="state.form.last_name"
                />
                <small
                  v-if="
                    state.validation.errors && state.validation.errors.last_name
                  "
                  class="text-danger"
                >
                  {{ state.validation.errors.last_name[0] }}
                </small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="checkout-form-list">
                <label for="email"
                  >Email Address <span class="required">*</span></label
                >
                <input
                  type="email"
                  name="email"
                  id="email"
                  placeholder="Enter your email address"
                  v-model="state.form.email"
                  :readonly="state.user != null"
                />
                <small
                  v-if="
                    state.validation.errors && state.validation.errors.email
                  "
                  class="text-danger"
                >
                  {{ state.validation.errors.email[0] }}
                </small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="checkout-form-list">
                <label for="phone">Phone <span class="required">*</span></label>
                <input
                  type="text"
                  name="phone"
                  id="phone"
                  placeholder="Enter your phone number"
                  v-model="state.form.phone"
                />
                <small
                  v-if="
                    state.validation.errors && state.validation.errors.phone
                  "
                  class="text-danger"
                >
                  {{ state.validation.errors.phone[0] }}
                </small>
              </div>
            </div>
            <div class="col-md-12">
              <div class="checkout-form-list">
                <label for="address"
                  >Address <span class="required">*</span></label
                >
                <input
                  placeholder="Street address, Apartment, suite, unit etc"
                  id="address"
                  type="text"
                  name="address"
                  v-model="state.form.address"
                />
                <small
                  v-if="
                    state.validation.errors && state.validation.errors.address
                  "
                  class="text-danger"
                >
                  {{ state.validation.errors.address[0] }}
                </small>
              </div>
            </div>
            <div class="col-md-12">
              <div class="checkout-form-list">
                <label for="shipping_address"
                  >Shipping Address <span class="required">*</span></label
                >
                <input
                  placeholder="Street address, Apartment, suite, unit etc"
                  type="text"
                  id="shipping_address"
                  name="shipping_address"
                  v-model="state.form.shipping_address"
                />
                <small
                  v-if="
                    state.validation.errors &&
                    state.validation.errors.shipping_address
                  "
                  class="text-danger"
                >
                  {{ state.validation.errors.shipping_address[0] }}
                </small>
              </div>
            </div>

            <div class="col-md-12" v-if="!state.user">
              <div class="col-md-12">
                <input
                  type="checkbox"
                  name="create_account"
                  id="create_account"
                  v-model="state.form.create_account"
                  value="1"
                />
                <label for="create_account">Create Account?</label>
              </div>
            </div>

            <div class="order-notes mt-3">
              <div class="checkout-form-list checkout-form-list-2">
                <label>Order Notes</label>
                <textarea
                  name="order_notes"
                  id="checkout-mess"
                  cols="30"
                  rows="10"
                  placeholder="Notes about your order, e.g. special notes for delivery."
                  v-model="state.form.order_notes"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-12">
        <div class="your-order">
          <h3>Your order</h3>
          <div class="your-order-table table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="cart-product-name">Product</th>
                  <th class="cart-product-total">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="cart_item"
                  v-for="(product, index) in state.products"
                  :key="index"
                >
                  <td class="cart-product-name">
                    {{ product.item.name }}
                    <strong class="product-quantity"
                      >× {{ product.qty }}</strong
                    >
                  </td>
                  <td class="cart-product-total text-center">
                    <span class="amount">
                      {{ product.item.price * product.qty }}&nbsp;tk
                    </span>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="cart-subtotal">
                  <th>Cart Subtotal</th>
                  <td class="text-center">
                    <span class="amount">{{ state.total_price }}&nbsp;tk</span>
                  </td>
                </tr>
                <tr class="order-total">
                  <th>Order Total</th>
                  <td class="text-center">
                    <strong
                      ><span class="amount">
                        {{ state.total_price }}&nbsp;tk
                      </span></strong
                    >
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="payment-method">
            <div class="payment-accordion">
              <div id="accordion">
                <div class="card">
                  <div class="card-header" id="#payment-3">
                    <h5 class="panel-title mb-2">
                      <a
                        href="#"
                        class="collapsed"
                        data-toggle="collapse"
                        data-target="#collapseThree"
                        aria-expanded="false"
                        aria-controls="collapseThree"
                      >
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        Delivery charge calander
                      </a>
                    </h5>
                  </div>
                  <div class="mt-3">
                    <h6 class="mb-3">Payment Method</h6>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        v-model="state.form.payment_method"
                        id="cash"
                        value="cash"
                      />
                      <label class="form-check-label" for="cash"> Cash </label>
                    </div>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        v-model="state.form.payment_method"
                        id="bkash"
                        value="bkash"
                        checked
                      />
                      <label class="form-check-label" for="bkash">
                        Bkash
                      </label>
                    </div>
                  </div>
                  <div
                    id="collapseThree"
                    class="collapse"
                    data-parent="#accordion"
                  >
                    <div class="card-body mb-2 mt-2">
                      <p>
                        Make your payment directly into our bank account. Please
                        use your Order ID as the payment reference. Your order
                        won’t be shipped until the funds have cleared in our
                        account.
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="order-button-payment">
                <button
                  type="submit"
                  class="btn obrien-button black-btn w-100 mt-5 rounded-0"
                  :disabled="state.submitting"
                >
                  <span v-if="state.submitting">Placing order...</span>
                  <span v-else>Place Order</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import { reactive } from "vue";

export default {
  props: ["user_is_auth", "data", "total_price", "user"],
  setup({ user_is_auth, data, total_price, user }) {
    const state = reactive({
      form: {
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
        address: "",
        shipping_address: "",
        create_account: null,
        order_notes: "",
        payment_method: "",
      },
      validation: {
        errors: [],
        message: "",
      },
      submitting: false,
      products: JSON.parse(data),
      total_price: total_price,
      user: JSON.parse(user),
    });

    if (state.user) {
      state.form.first_name = state.user.userinfo.first_name;
      state.form.last_name = state.user.userinfo.last_name;
      state.form.email = state.user.email;
      state.form.phone = state.user.userinfo.phone;
      state.form.address = state.user.userinfo.address;
    }

    const handleFormSubmit = () => {
      state.submitting = true;
      state.validation.errors = [];
      state.validation.message = "";

      axios
        .post("/checkout", state.form)
        .then((response) => {
          if (response.data.success) {
            location.href = response.data.success_link;
          }
        })
        .catch((error) => {
          state.submitting = false;
          state.validation.errors = error.response.data.errors;
          state.validation.message = "Email already taken.";
        });
    };

    return {
      state,
      handleFormSubmit,
    };
  },
};
</script>
