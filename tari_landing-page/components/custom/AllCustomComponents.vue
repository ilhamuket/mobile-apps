<template>
  <div>
    <!-- -----------------------------------------------
    Header
    ----------------------------------------------- -->
    <app-video />
    <app-what id="what" />
    <!-- <keunggulan id="keunggulan" /> -->
    <!-- <Header1 /> -->
    <!-- <Header2 /> -->
    <!-- -----------------------------------------------
    ./ Header
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Banner
    ----------------------------------------------- -->
    <!-- <BannerText /> -->
    <Banner1 />
    <!-- <Banner2 /> -->
    <!-- -----------------------------------------------
    ./ Banner
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Form Banner
    ----------------------------------------------- -->
    <FormBanner1 />
    <!-- <FormBannerText /> -->

    <!-- -----------------------------------------------
    ./ Form Banner
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Features
    ----------------------------------------------- -->
    <!-- <FeatureText id="fitur" /> -->
    <Feature1 />
    <live id="live" />
    <vidio id="vidio" />
    <!-- <Feature2 /> -->
    <!-- <Feature3 /> -->
    <!-- -----------------------------------------------
    ./ Features
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Portfolio
    ----------------------------------------------- -->
    <!-- <Favorit />
     -->
    <!-- -----------------------------------------------
    ./ Portfolio
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Pricing
    ----------------------------------------------- -->
     <!-- <PricingText /> -->
    <!-- <Pricing />  -->
    <!-- -----------------------------------------------
    ./ Pricing
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Team
    ----------------------------------------------- -->
    <TeamText id="payment" />
    <!-- <Team /> -->
    <!-- -----------------------------------------------
    ./ Team
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Testimonial
    ----------------------------------------------- -->
    <!-- <TestimonialText /> -->
    <Testimonial />
    <!-- <Setting /> -->
    <!-- -----------------------------------------------
    ./ Testimonial
    ----------------------------------------------- -->

    <!-- -----------------------------------------------
    C2a
    ----------------------------------------------- -->
    <!-- <C2aText />
    <C2a1 />
    <C2a2 /> -->
    <!-- -----------------------------------------------
    ./ C2a
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Contact Text
    ----------------------------------------------- -->
    <!-- <ContactText /> -->
    <Contact id="kontak"/>
    <!-- -----------------------------------------------
    ./ Contact Text
    ----------------------------------------------- -->
  </div>
</template>

<script>
import what from "./what/what.vue";
import video from "./video/index.vue";
export default {
  name: "AllCustomComponents",

  data() {
    return {};
  },
  components: {
    keunggulan: () => import("@/components/custom/Keunggulan/Keunggulan"),
    BannerText: () => import("@/components/custom/ListKeunggulan/BannerText"),
    FeatureText: () => import("@/components/custom/features/FeatureText"),
    PricingText: () => import("@/components/custom/pricing/PricingText"),
    TeamText: () => import("@/components/custom/team/TeamText"),
    ContactText: () => import("@/components/custom/contact/ContactText"),
    TestimonialText: () =>
      import("@/components/custom/testimonial/TestimonialText"),
    C2aText: () => import("@/components/custom/c2a/C2aText"),
    Favorit: () => import("@/components/custom/favorit/Favorit"),
    FormBannerText: () =>
      import("@/components/custom/form-banner/FormBannerText"),
    Header1: () => import("@/components/custom/Keunggulan/Header1"),
    Header2: () => import("@/components/custom/Keunggulan/Header2"),
    Banner1: () => import("@/components/custom/ListKeunggulan/Banner1"),
    Banner2: () => import("@/components/custom/ListKeunggulan/Banner2"),
    Feature1: () => import("@/components/custom/features/Feature1"),
    Feature2: () => import("@/components/custom/features/Feature2"),
    Feature3: () => import("@/components/custom/features/Feature3"),
    FormBanner1: () => import("@/components/custom/form-banner/FormBanner1"),
    Live: () => import("@/components/custom/favorit/EnsikloLive"),
    vidio: () => import("@/components/custom/favorit/EnsikloVidio"),
    Pricing: () => import("@/components/custom/pricing/Pricing"),
    Team: () => import("@/components/custom/team/Team"),
    Testimonial: () => import("@/components/custom/testimonial/Testimonial"),
    Blog: () => import("@/components/custom/blogs/Blog"),
    C2a1: () => import("@/components/custom/c2a/C2a1"),
    C2a2: () => import("@/components/custom/c2a/C2a2"),
    Contact: () => import("@/components/custom/contact/Contact"),
    Setting: () => import("@/components/Setting"),
    "app-video": video,
    "app-what": what,
  },
};
</script>
<style lang="sass">
html
  scroll-behavior: smooth !important
</style>