    <div class="col-md-4 text-center">
        <a href="{blesta_url}order/main/index/dom/">
		<div class="card bg-gradient-success" style="background:#45ba74">
			<div class="card-body skew-shadow">
                <i class="fa fa-globe fa-4x text-white"></i>
                <h3 class="text-white">Domain</h3>
                <p class="text-white">Choose your domain name</p>
            </div></div>
        </a>
    </div>

    <div class="col-md-4 text-center">
        <a href="{blesta_url}order/main/index/host">
		<div class="card bg-gradient-success" style="background:#45ba74">
			<div class="card-body skew-shadow">

                <i class="fa fa-hdd fa-4x text-white"></i>
                <h3 class="text-white">Cheap Hosting</h3>
                <p class="text-white">Choose your Cloud Hosting</p>
            </div></div>
        </a>
    </div>

    <div class="col-md-4 text-center">
        <a href="{client_url}login/">
		<div class="card bg-gradient-success" style="background:#45ba74">
			<div class="card-body skew-shadow">

                <i class="fa fa-cogs fa-4x text-white"></i>
                <h3 class="text-white">My Account</h3>
                <p class="text-white">Log in here to manage your account.</p>
            </div></div>
        </a>
    </div>
<div class="w-100"></div>
    {% if plugins.support_manager.enabled %}<div class="col-md-4 text-center">
        <a href="{client_url}plugin/support_manager/client_tickets/add/">
            <div class="card card-dark bg-gradient-succes" style="background:#45ba74">
			<div class="card-body skew-shadow">
                <i class="fas fa-hands-helping fa-4x text-white"></i>
                <h3 class="text-white">Support</h3>
                <p class="text-white">Looking for help? You can open a trouble ticket here.</p>
            </div></div>
        </a>
    </div>
	<div class="col-md-4 text-center">
        <a href="{client_url}plugin/support_manager/knowledgebase/">
            <div class="card bg-gradient-success" style="background:#45ba74">
				<div class="card-body bubble-shadow">
					<i class="fa fa-info fa-4x text-white"></i>
					<h3 class="text-white">Knowledge Base</h3>
					<p class="text-white">Have a question? Search the knowledge base for an answer.</p>
				</div>
			</div>
        </a>
    </div>{% endif %}
    {% if plugins.order.enabled %}<div class="col-md-4 text-center">
        <a href="{blesta_url}order/">
			<div class="card bg-gradient-success" style="background:#45ba74">
				<div class="card-body curves-shadow">
					<i class="fa fa-shopping-cart fa-4x text-white"></i>
					<h3 class="text-white">Order</h3>
					<p class="text-white">Visit the order form to sign up and purchase new products and services.</p>
				</div>
			</div>
        </a>
    </div>{% endif %}
    {% if plugins.download_manager.enabled %}<div class="col-md-4 text-center">
        <a href="{client_url}plugin/download_manager/">
			<div class="card bg-gradient-success" style="background:#45ba74">
				<div class="card-body bubble-shadow">
					<i class="fa fa-download fa-4x text-white"></i>
					<h3 class="text-white">Download</h3>
					<p class="text-white">You may need to be logged in to access certain downloads here.</p>
				</div>
			</div>
        </a>
    </div>{% endif %}
