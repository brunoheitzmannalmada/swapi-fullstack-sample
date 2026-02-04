<template>
    <section class="base-card">
        <slot />
    </section>
</template>

<style lang="css" scoped>
.base-card {
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 0.5px 1px 0 #848484bf;
  border: solid 0.5px #dadada;
  background-color: #fff;
}
</style>