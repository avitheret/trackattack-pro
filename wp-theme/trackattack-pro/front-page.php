<?php
/**
 * Homepage template — TrackAttack Pro
 */
$img = get_template_directory_uri() . '/assets/images/';
get_header();
?>

<main id="content">

<!-- ─── HERO ─── -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-content">
    <h1>Conquer. Every. Drive.</h1>
    <p class="subtitle">Ultimate Track Day Weapon</p>
  </div>
</section>

<!-- ─── PRESENTED BY ─── -->
<div class="presented-by"><p>Presented By</p></div>

<!-- ─── FEATURES ─── -->
<section class="features reveal">
  <div class="features-image"><div class="tire-render"></div></div>
  <ul class="features-list">
    <li><div class="check-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div><strong>UTQG 200</strong> rated <strong>Extreme Performance Summer</strong> tire</div></li>
    <li><div class="check-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div>Engineered for <strong>track dominance</strong> and <strong>street performance</strong> with <strong>Hoosier Racing DNA</strong></div></li>
    <li><div class="check-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div>Addictive levels of <strong>responsiveness</strong> and <strong>handling</strong></div></li>
    <li><div class="check-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div><strong>Unrivaled grip</strong> derived from motorsports-proven compounds</div></li>
    <li><div class="check-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div><strong>Adrenaline fueled acceleration</strong> fused with <strong>dynamic braking</strong></div></li>
  </ul>
</section>

<!-- ─── VIDEO ─── -->
<section class="video-section">
  <div class="video-inner">
    <button class="play-btn" aria-label="Play video"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg></button>
    <p class="play-label">Play Video</p>
  </div>
</section>

<!-- ─── TECH CALLOUTS ─── -->
<section class="tech-callouts reveal">
  <div class="tech-inner">
    <div class="tire-center"></div>
    <div class="callout-grid">
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div><p><strong>Extra-wide shoulder ribs</strong> maximize cornering performance</p></div>
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="3"/></svg></div><p><strong>Featherlight construction</strong> provides peak responsiveness</p></div>
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M12 6v6l4 2" stroke="white" fill="none"/></svg></div><p><strong>H-DNA technology:</strong> 65+ years of Hoosier Racing DNA</p></div>
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="0"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></div><p><strong>Optimized center rib</strong> for increased braking performance</p></div>
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><p><strong>Motorsports derived compound</strong></p></div>
    </div>
  </div>
</section>

<!-- ─── GALLERY ─── -->
<section class="gallery reveal">
  <div class="gallery-header">
    <h2>For Drivers</h2>
    <p>...brings track dominance to the street</p>
  </div>
  <div class="gallery-grid">
    <img class="gallery-img" src="<?php echo esc_url($img); ?>TAP-2000x1000-master8.jpg" alt="C8 Corvette front view with TrackAttack Pro tires">
    <img class="gallery-img" src="<?php echo esc_url($img); ?>TAP-2000x1000-master6.jpg" alt="C8 Corvette rear view with TrackAttack Pro tires">
  </div>
</section>

<!-- ─── ABOUT ─── -->
<section class="about-overlay">
  <div class="about-content reveal">
    <h2>TrackAttack Pro</h2>
    <p>...masters both street and track. Harnessing Hoosier&#8217;s unparalleled racing DNA, taking track dominance to the street, the TrackAttack Pro drives highly addictive performance.</p>
  </div>
</section>

<!-- ─── CTA BANNER ─── -->
<section class="cta-banner">
  <div class="cta-banner-content reveal">
    <h2>Revolutionary extreme performance summer tire</h2>
    <p>&#8230;awakens daily commutes, empowers epic track days &ndash; and ignites legendary journeys in between.</p>
  </div>
</section>

<!-- ─── CINEMATIC TIRE ─── -->
<section class="cinematic-tire">
  <div class="cinematic-tire-inner"><div class="tire-hero-img"></div></div>
</section>

<!-- ─── SPECS SUMMARY ─── -->
<section class="specs-summary">
  <div class="specs-header">
    <img src="<?php echo esc_url($img); ?>TAP-Logo@4x.png" alt="TrackAttack Pro" style="max-width:400px;width:100%;margin:0 auto 8px;display:block;">
    <p class="specs-sub">| Product Data</p>
    <p class="specs-sub" style="margin-top:4px;">Extreme Performance Summer &nbsp;|&nbsp; Ultra-High Performance</p>
  </div>
  <div style="position:relative;z-index:1;max-width:var(--container-max);margin:0 auto;text-align:center;">
    <img src="<?php echo esc_url($img); ?>Specs.png" alt="Product Specifications" style="max-width:100%;height:auto;">
  </div>
</section>

<!-- ─── RADAR CHARTS ─── -->
<section class="radar-section" style="background:var(--surface);position:relative;overflow:hidden;">
  <div class="radar-grid" style="position:relative;z-index:1;display:grid;grid-template-columns:1fr 1fr;gap:var(--gutter);max-width:var(--container-max);margin:0 auto;">
    <div class="radar-card reveal" style="position:relative;overflow:hidden;border:1px solid var(--outline-variant);background:url('<?php echo esc_url($img); ?>IMG_3706.jpg') center/cover no-repeat;">
      <div style="position:absolute;inset:0;background:rgba(19,19,19,0.6);"></div>
      <img src="<?php echo esc_url($img); ?>spider1B@2x.png" alt="TrackAttack vs Extreme Contact Force" style="position:relative;z-index:1;max-width:100%;height:auto;display:block;margin:0 auto;">
    </div>
    <div class="radar-card reveal" style="position:relative;overflow:hidden;border:1px solid var(--outline-variant);background:url('<?php echo esc_url($img); ?>IMG_4130.jpg') center/cover no-repeat;">
      <div style="position:absolute;inset:0;background:rgba(19,19,19,0.6);"></div>
      <img src="<?php echo esc_url($img); ?>spider2B@2x.png" alt="TrackAttack vs Hoosier R7" style="position:relative;z-index:1;max-width:100%;height:auto;display:block;margin:0 auto;">
    </div>
  </div>
</section>

<!-- ─── H-DNA ─── -->
<section class="hdna-section reveal">
  <div class="hdna-image">
    <img src="<?php echo esc_url($img); ?>HDNA-white.png" alt="H-DNA" style="max-width:280px;width:100%;height:auto;position:relative;z-index:1;">
  </div>
  <div class="hdna-content">
    <h2>Hoosier DNA</h2>
    <p>Pushing boundaries and defying limits. H-DNA was forged from a legacy of unrivaled racing excellence and relentless performance. Ignite your passion, empower your pride and drive your success as you conquer life on and off the track.</p>
  </div>
</section>

<!-- ─── TOTAL DOMINANCE ─── -->
<section class="dominance reveal">
  <h2>Total Dominance Plan</h2>
  <p>Experience unmatched performance with the Total Dominance Plan, where Hoosier high-performance tires set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing and expert endorsements, all Hoosier tires promises superior performance on every drive. Choose the Total Dominance Plan and elevate your driving experience to the next level.</p>
</section>

<!-- ─── PRODUCT TABLE ─── -->
<div class="availability-note">
  <h3>Availability</h3>
  <p>Over 40 sizes set to be released to accommodate the most popular fitments for ultra high performance applications.</p>
</div>
<div class="product-data-header">
  <img src="<?php echo esc_url($img); ?>TAP-Logo@4x.png" alt="TrackAttack Pro" style="height:40px;width:auto;">
  <span class="pd-label">| Product Data</span>
</div>
<div class="table-container">
  <table class="data-table">
    <thead><tr>
      <th>RIM DIA (IN)</th><th>TIRE SIZE</th><th>LOAD / SPEED INDEX</th><th>LOAD RANGE</th><th>TREAD DEPTH</th><th>PRODUCT CODE</th><th>RIM WIDTH RANGE</th><th>MEASURE D RIM</th><th>OD [MM]</th><th>OD [IN]</th><th>SECTION [MM]</th><th>SECTION [IN]</th><th>TREAD WIDTH [MM]</th><th>TREAD WIDTH [IN]</th><th>MAX LOAD [KG/LBF]</th><th>MAX PRESSURE</th><th>UTQG</th><th>WEIGHT [LBM]</th><th>AVAILABILITY</th>
    </tr></thead>
    <tbody>
      <tr class="rim-group"><td rowspan="2">15</td><td>205/50 R15</td><td>89V</td><td>XL</td><td>5.3</td><td>47503</td><td>5.5 - 7.5</td><td>6.5</td><td>591</td><td>23.3</td><td>213</td><td>8.4</td><td>186</td><td>7.3</td><td>580/1279</td><td>51</td><td>200 AA</td><td>17.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>225/45 R15</td><td>91V</td><td>XL</td><td>5.3</td><td>47511</td><td>7 - 8.5</td><td>7.5</td><td>587</td><td>23.1</td><td>225</td><td>8.9</td><td>194</td><td>7.6</td><td>615/1356</td><td>51</td><td>200 AA</td><td>17.6</td><td><span class="badge badge-upcoming">Q3 2026</span></td></tr>
      <tr class="rim-group"><td rowspan="4">17</td><td>225/40 ZR17</td><td>90W</td><td>XL</td><td>5.3</td><td>47706</td><td>7.5 - 9</td><td>8</td><td>618</td><td>24.3</td><td>233</td><td>9.2</td><td>201</td><td>7.9</td><td>600/1323</td><td>51</td><td>200 AA</td><td>18.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>225/45 ZR17</td><td>94W</td><td>XL</td><td>5.3</td><td>47711</td><td>7 - 8.5</td><td>7.5</td><td>631</td><td>24.8</td><td>228</td><td>9.0</td><td>210</td><td>8.3</td><td>670/1477</td><td>51</td><td>200 AA</td><td>19.3</td><td><span class="badge badge-upcoming">Q3 2026</span></td></tr>
      <tr><td>245/40 ZR17</td><td>95W</td><td>XL</td><td>5.3</td><td>47716</td><td>8 - 9.5</td><td>8.5</td><td>633</td><td>24.9</td><td>249</td><td>9.8</td><td>220</td><td>8.7</td><td>690/1521</td><td>51</td><td>200 AA</td><td>19.6</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>255/40 ZR17</td><td>98W</td><td>XL</td><td>5.3</td><td>47724</td><td>8.5 - 10</td><td>9</td><td>641</td><td>25.2</td><td>262</td><td>10.3</td><td>228</td><td>9.0</td><td>750/1654</td><td>51</td><td>200 AA</td><td>21.3</td><td><span class="badge badge-upcoming">Q3 2026</span></td></tr>
      <tr class="rim-group"><td rowspan="10">18</td><td>245/35 ZR18</td><td>92W</td><td>XL</td><td>5.3</td><td>47820</td><td>8 - 9.5</td><td>8.5</td><td>634</td><td>25.0</td><td>250</td><td>9.8</td><td>219</td><td>8.6</td><td>630/1389</td><td>51</td><td>200 AA</td><td>19.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>245/40 ZR18</td><td>97Y</td><td>XL</td><td>5.3</td><td>47822</td><td>8 - 9.5</td><td>8.5</td><td>658</td><td>25.9</td><td>249</td><td>9.8</td><td>217</td><td>8.5</td><td>730/1610</td><td>51</td><td>200 AA</td><td>20.1</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>265/35 ZR18</td><td>(97Y)</td><td>XL</td><td>5.3</td><td>47830</td><td>9 - 10.5</td><td>9.5</td><td>652</td><td>25.7</td><td>274</td><td>10.8</td><td>231</td><td>9.1</td><td>730/1610</td><td>51</td><td>200 AA</td><td>20.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>265/40 ZR18</td><td>(101Y)</td><td>XL</td><td>5.3</td><td>47832</td><td>9 - 10.5</td><td>9.5</td><td>673</td><td>26.5</td><td>276</td><td>10.9</td><td>238</td><td>9.4</td><td>825/1819</td><td>51</td><td>200 AA</td><td>23.1</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>275/35 ZR18</td><td>(99Y)</td><td>XL</td><td>5.3</td><td>47836</td><td>9 - 11</td><td>9.5</td><td>649</td><td>25.6</td><td>278</td><td>10.9</td><td>252</td><td>9.9</td><td>775/1709</td><td>51</td><td>200 AA</td><td>22.0</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>295/30 ZR18</td><td>(98Y)</td><td>XL</td><td>5.3</td><td>47840</td><td>10 - 11</td><td>10.5</td><td>642</td><td>25.3</td><td>301</td><td>11.9</td><td>276</td><td>10.9</td><td>750/1654</td><td>51</td><td>200 AA</td><td>22.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>295/35 ZR18</td><td>(103Y)</td><td>XL</td><td>5.3</td><td>47844</td><td>10 - 11.5</td><td>10.5</td><td>667</td><td>26.3</td><td>300</td><td>11.8</td><td>272</td><td>10.7</td><td>875/1929</td><td>51</td><td>200 AA</td><td>23.3</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>295/40 ZR18</td><td>103W</td><td>SL</td><td>5.3</td><td>47846</td><td>10 - 11.5</td><td>10.5</td><td>697</td><td>27.4</td><td>300</td><td>11.8</td><td>267</td><td>10.5</td><td>875/1929</td><td>51</td><td>200 AA</td><td>24.4</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>315/30 ZR18</td><td>(98Y)</td><td>SL</td><td>5.3</td><td>47854</td><td>10.5 - 11.5</td><td>11</td><td>651</td><td>25.6</td><td>318</td><td>12.5</td><td>305</td><td>12.0</td><td>750/1654</td><td>51</td><td>200 AA</td><td>24.3</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>335/30 ZR18</td><td>(102Y)</td><td>SL</td><td>5.3</td><td>47858</td><td>11.5 - 12.5</td><td>12</td><td>669</td><td>26.3</td><td>339</td><td>13.3</td><td>314</td><td>12.4</td><td>850/1874</td><td>51</td><td>200 AA</td><td>26.6</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr class="rim-group"><td rowspan="8">19</td><td>235/35 ZR19</td><td>(91Y)</td><td>XL</td><td>5.3</td><td>47910</td><td>8 - 9.5</td><td>8.5</td><td>654</td><td>25.8</td><td>247</td><td>9.7</td><td>215</td><td>8.4</td><td>615/1356</td><td>51</td><td>200 AA</td><td>20.5</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>245/35 ZR19</td><td>(93Y)</td><td>XL</td><td>5.3</td><td>47914</td><td>8 - 9.5</td><td>8.5</td><td>663</td><td>26.1</td><td>248</td><td>9.8</td><td>221</td><td>8.7</td><td>650/1433</td><td>51</td><td>200 AA</td><td>20.6</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>265/30 ZR19</td><td>(93Y)</td><td>XL</td><td>5.3</td><td>47922</td><td>9 - 10</td><td>9.5</td><td>648</td><td>25.5</td><td>272</td><td>10.7</td><td>245</td><td>9.6</td><td>650/1433</td><td>51</td><td>200 AA</td><td>22.1</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>265/35 ZR19</td><td>(98Y)</td><td>XL</td><td>5.3</td><td>47924</td><td>9 - 10.5</td><td>9.5</td><td>668</td><td>26.3</td><td>275</td><td>10.8</td><td>237</td><td>9.3</td><td>850/1874</td><td>51</td><td>200 AA</td><td>24.2</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>275/35 ZR19</td><td>(100Y)</td><td>XL</td><td>5.3</td><td>47930</td><td>9 - 11</td><td>9.5</td><td>679</td><td>26.7</td><td>275</td><td>10.8</td><td>243</td><td>9.6</td><td>800/1764</td><td>51</td><td>200 AA</td><td>22.7</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>285/35 ZR19</td><td>(103Y)</td><td>XL</td><td>5.3</td><td>47934</td><td>9.5 - 11</td><td>10</td><td>689</td><td>27.1</td><td>289</td><td>11.4</td><td>258</td><td>10.2</td><td>875/1929</td><td>51</td><td>200 AA</td><td>23.0</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>295/30 ZR19</td><td>(100Y)</td><td>XL</td><td>5.3</td><td>47938</td><td>10 - 11</td><td>10.5</td><td>664</td><td>26.1</td><td>300</td><td>11.8</td><td>273</td><td>10.7</td><td>800/1764</td><td>51</td><td>200 AA</td><td>23.3</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>305/30 ZR19</td><td>(102Y)</td><td>XL</td><td>5.3</td><td>47944</td><td>10.5 - 11.5</td><td>11</td><td>672</td><td>26.4</td><td>311</td><td>12.2</td><td>279</td><td>11.0</td><td>850/1874</td><td>51</td><td>200 AA</td><td>24.1</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr class="rim-group"><td rowspan="10">20</td><td>245/30 ZR20</td><td>(90Y)</td><td>XL</td><td>5.3</td><td>47960</td><td>8 - 9</td><td>8.5</td><td>666</td><td>26.2</td><td>243</td><td>9.6</td><td>223</td><td>8.8</td><td>600/1323</td><td>51</td><td>200 AA</td><td>21.2</td><td><span class="badge badge-upcoming">Q3 2026</span></td></tr>
      <tr><td>245/35 ZR20</td><td>(95Y)</td><td>XL</td><td>5.3</td><td>47962</td><td>8 - 9.5</td><td>8.5</td><td>686</td><td>27.0</td><td>247</td><td>9.7</td><td>220</td><td>8.7</td><td>690/1521</td><td>51</td><td>200 AA</td><td>22.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>265/30 ZR20</td><td>(94Y)</td><td>XL</td><td>5.3</td><td>47964</td><td>9 - 10</td><td>9.5</td><td>674</td><td>26.5</td><td>270</td><td>10.6</td><td>245</td><td>9.7</td><td>670/1477</td><td>51</td><td>200 AA</td><td>22.1</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>265/35 ZR20</td><td>(99Y)</td><td>XL</td><td>5.3</td><td>47966</td><td>9 - 10.5</td><td>9.5</td><td>700</td><td>27.5</td><td>270</td><td>10.6</td><td>238</td><td>9.4</td><td>775/1709</td><td>51</td><td>200 AA</td><td>22.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>275/30 ZR20</td><td>(97Y)</td><td>XL</td><td>5.3</td><td>47968</td><td>9 - 10</td><td>9.5</td><td>680</td><td>26.8</td><td>273</td><td>10.7</td><td>247</td><td>9.7</td><td>730/1610</td><td>51</td><td>200 AA</td><td>23.1</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>285/30 ZR20</td><td>(99Y)</td><td>XL</td><td>5.3</td><td>47970</td><td>9.5 - 10.5</td><td>10</td><td>688</td><td>27.1</td><td>284</td><td>11.2</td><td>261</td><td>10.3</td><td>775/1709</td><td>51</td><td>200 AA</td><td>23.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>295/30 ZR20</td><td>(101Y)</td><td>XL</td><td>5.3</td><td>47974</td><td>10 - 11</td><td>10.5</td><td>692</td><td>27.3</td><td>297</td><td>11.7</td><td>268</td><td>10.6</td><td>825/1819</td><td>51</td><td>200 AA</td><td>24.1</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>305/30 ZR20</td><td>(103Y)</td><td>XL</td><td>5.3</td><td>47978</td><td>10.5 - 11.5</td><td>11</td><td>697</td><td>27.4</td><td>310</td><td>12.2</td><td>279</td><td>11.0</td><td>875/1929</td><td>51</td><td>200 AA</td><td>25.5</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>305/35 ZR20</td><td>107Y</td><td>XL</td><td>5.3</td><td>47980</td><td>10 - 12</td><td>11</td><td>729</td><td>28.7</td><td>311</td><td>12.2</td><td>275</td><td>10.8</td><td>975/2150</td><td>51</td><td>200 AA</td><td>27.4</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>315/30 ZR20</td><td>(104Y)</td><td>XL</td><td>5.3</td><td>47982</td><td>10.5 - 11.5</td><td>11</td><td>705</td><td>27.8</td><td>311</td><td>12.2</td><td>285</td><td>11.2</td><td>900/1985</td><td>51</td><td>200 AA</td><td>26.4</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr class="rim-group"><td rowspan="4">21</td><td>265/30 ZR21</td><td>(96Y)</td><td>XL</td><td>5.3</td><td>47988</td><td>9 - 10</td><td>9.5</td><td>700</td><td>27.5</td><td>270</td><td>10.6</td><td>247</td><td>9.7</td><td>730/1610</td><td>51</td><td>200 AA</td><td>23.1</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>285/30 ZR21</td><td>(100Y)</td><td>XL</td><td>5.3</td><td>47990</td><td>9.5 - 11</td><td>10</td><td>710</td><td>27.9</td><td>289</td><td>11.4</td><td>267</td><td>10.5</td><td>800/1764</td><td>51</td><td>200 AA</td><td>24.8</td><td><span class="badge badge-available">AVAILABLE</span></td></tr>
      <tr><td>325/30 ZR21</td><td>(108Y)</td><td>XL</td><td>5.3</td><td>47994</td><td>11 - 12</td><td>11.5</td><td>745</td><td>29.3</td><td>319</td><td>12.6</td><td>294</td><td>11.6</td><td>1000/2205</td><td>51</td><td>200 AA</td><td>29.0</td><td><span class="badge badge-upcoming">Q3 2026</span></td></tr>
      <tr><td>345/25 ZR21</td><td>(104Y)</td><td>XL</td><td>5.3</td><td>47998</td><td>12 - 13</td><td>12.5</td><td>721</td><td>28.4</td><td>343</td><td>13.5</td><td>322</td><td>12.7</td><td>900/1985</td><td>51</td><td>200 AA</td><td>29.4</td><td><span class="badge badge-upcoming">Q3 2026</span></td></tr>
    </tbody>
  </table>
</div>
<p class="usdot-note">TrackAttack Pro is USDOT street legal only</p>

<!-- ─── RESOURCES ─── -->
<div class="resources-banner"><h2>TrackAttack Pro Resources</h2></div>
<div class="resources-grid">
  <div class="resource-card">
    <div class="resource-img"></div>
    <div class="resource-info">
      <h3>Detailed Product Specifications</h3>
      <p>TrackAttack Pro detailed product specifications can be downloaded here.</p>
      <p class="note">NOTE: All measurements are subject to change upon official size release.</p>
      <a href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/docs/TAP_ProductInfo.pdf" class="download-btn" target="_blank">Download</a>
    </div>
  </div>
  <div class="resource-card">
    <div class="resource-info">
      <h3>Tire Care and Safety Guidelines</h3>
      <p>Trackattack Pro detailed tire care procedures, best practices and safety guidelines.</p>
      <a href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/docs/TAP_TireCare.pdf" class="download-btn" target="_blank">Download</a>
    </div>
    <div class="resource-img tech-img"></div>
  </div>
</div>

<!-- ─── CONTACT FORM ─── -->
<section id="contact" class="contact-section reveal">
  <div class="contact-inner">
    <h2>צרו קשר</h2>
    <form class="contact-form" id="contactForm">
      <?php wp_nonce_field( 'tap_contact_nonce', 'tap_nonce' ); ?>
      <div class="form-section">
        <div class="form-group-title">פרטים אישיים</div>
        <div class="form-field"><label for="name">שם מלא</label><input type="text" id="name" name="name" required></div>
        <div class="form-field"><label for="email">אימייל</label><input type="email" id="email" name="email" required></div>
        <div class="form-field"><label for="phone">טלפון</label><input type="tel" id="phone" name="phone"></div>
      </div>
      <div class="form-section">
        <div class="form-group-title">פרטי רכב</div>
        <div class="form-field"><label for="manufacturer">יצרן</label><input type="text" id="manufacturer" name="manufacturer"></div>
        <div class="form-field"><label for="car_model">דגם</label><input type="text" id="car_model" name="model"></div>
        <div class="form-field"><label for="year">שנת ייצור</label><input type="text" id="year" name="year"></div>
        <div class="form-field">
          <label>אני מעוניין בגדלים...</label>
          <div class="multiselect-wrapper" id="tireSizeSelect">
            <div class="multiselect-trigger" id="tireSizeTrigger"><span class="trigger-text">בחרו גדלים</span><span class="arrow">&#9660;</span></div>
            <div class="multiselect-dropdown" id="tireSizeDropdown"></div>
            <div class="selected-tags" id="tireSizeTags"></div>
            <input type="hidden" name="tire_sizes" id="tireSizesHidden">
          </div>
        </div>
        <div class="form-field"><label for="notes">הערות רשות</label><textarea id="notes" name="notes"></textarea></div>
      </div>
      <div style="grid-column:1/-1;text-align:center;">
        <button type="submit" class="submit-btn">שלח</button>
        <div class="form-notice" id="formNotice"></div>
      </div>
    </form>
  </div>
</section>

</main>

<?php get_footer();
