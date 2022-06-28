<template>
  <footer>
    <div
      class="container-fluid d-flex justify-content-between align-items-center"
      id="footer"
    >
      <div class="col">
        <h5><fa :icon="['fab', 'facebook-f']" /> |</h5>
        <h6>facebook</h6>
      </div>
      <div class="col">
        <h5><fa :icon="['fab', 'linkedin-in']" /> |</h5>
        <h6>linkedin</h6>
      </div>
      <div class="col">
        <h5><fa :icon="['fab', 'twitter']" /> |</h5>
        <h6>twitter</h6>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  name: "monFooter",
};
</script>

<style>
#footer {
  height: 5em;
  background: #303133;
  color: #ffff;
}
</style>