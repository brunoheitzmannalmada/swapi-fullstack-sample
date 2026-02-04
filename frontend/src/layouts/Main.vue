<template>
    <div class="main-layout">
        <div class="header">SWAPI Fullstack Sample</div>

        <div class="content">
            <slot />
        </div>
    </div>
</template>

<style lang="css">
.main-layout {
    display: grid;
    grid-template-rows: auto 1fr;
    min-height: 100vh;
}

.header {
    width: 720px;
    height: 25px;
    margin: 0;
    padding: 7px 335.5px;
    box-shadow: 0 1px 0 0 #dadada;
    background-color: #fff;
    color: #0ab463;
}

.content {
    background-color: #ededed;
}

@media (max-width: 768px) {
  .main-layout {
    min-height: 100vh;
  }

  .header {
    width: 100vw;
    padding: 1px 1px;
    text-align: center;
  }
}

</style>