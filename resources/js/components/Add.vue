// AddComponent.vue

<template>
   <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Add Coin</div>

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control"  required autofocus>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>

<script>
   export default {
      data() {
         return {
            coin: {}
         }
      },
      methods: {
         addCoin() {
            alert('submitted');
         }
      }
   }
</script>