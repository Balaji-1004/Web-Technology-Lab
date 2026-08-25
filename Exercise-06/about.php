<?php
$page_title = "About us";
require "header.php";
?>
<section class="page-heading shell"><p class="eyebrow">THE DEPARTMENT</p><h1>People first.<br><em>Technology second.</em></h1><p>We are a department for patient thinkers, practical builders, and anyone who believes a good question is the start of good software.</p></section>
<section class="shell about-grid">
  <div class="about-statement"><p class="eyebrow">OUR APPROACH</p><h2>Computer science is more than code.</h2><p>Our learning culture connects strong technical fundamentals with communication, collaboration, and responsible problem-solving. Students are encouraged to make things, explain things, and keep asking better questions.</p></div>
  <div class="principles" id="principles">
    <button class="principle active" data-panel="learn"><span>01</span><strong>Learn by doing</strong><b>+</b></button>
    <div class="principle-panel" id="learn">Every concept earns its place in a project, a lab, or a conversation.</div>
    <button class="principle" data-panel="share"><span>02</span><strong>Share the work</strong><b>+</b></button>
    <div class="principle-panel hidden" id="share">Clear documentation and generous teamwork make technical ideas stronger.</div>
    <button class="principle" data-panel="care"><span>03</span><strong>Build with care</strong><b>+</b></button>
    <div class="principle-panel hidden" id="care">We consider accessibility, security, and the people who will live with our decisions.</div>
  </div>
</section>
<section class="shell quote-band"><p>"The best solutions begin<br>with <em>understanding.</em>"</p><span>DCS / PRINCIPLE 01</span></section>
<?php require "footer.php"; ?>
