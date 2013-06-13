<?php include 'header.php'; ?>

<h1>Bonjour mes chers</h1>
<h2>Comment allez-vous?</h2>

<p>J'ai essayé de créer une base typographique. Sentez vous libre de changer <code>typography.less</code> comme vous voulez. Il faudra alors re-génerer <code>typography.css</code> avec <a href="http://wearekiss.com/simpless">Simpless</a> ou <a href="http://incident57.com/less/">Less.app</a> </p>

<ul
  <li>List item 1</li>
  <li>List item 2</li>
  <li>List item 3</li>
</ul>

<h2>Aliquam lorem ante</h2>
<h3>Sed in viverra quis</h3>
<p>dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.</p>

<h3>Sed fringilla mauris sit amet nibh</h3>
<p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, <strong>mollis</strong> sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris.</p>

<form action="" method="post">
  <fieldset>
    <legend>Noms</legend>
    <label>Prenom :</label>
    <input type="text" name="prenom" value="" />
    <label>Nom :</label>
    <input type="text" name="nom" value="" />
  </fieldset>
  <label>Description</label>
  <textarea name="description"></textarea>
  <label>Gender</label>
  Male <input type="radio" class="radio" value="male" name="gender" />
  Female <input type="radio" class="radio" value="female" name="gender" />

  <label>Tout ok?</label>
  <input type="checkbox" class="checkbox" value="ok" name="ok" />
  <fieldset>
  <legend>Buttons</legend>
    <input type="submit" name="" value="Submit" />
    <button name="button">Button</button>
  </fieldset>
</form>

<?php include 'footer.php'; ?>
