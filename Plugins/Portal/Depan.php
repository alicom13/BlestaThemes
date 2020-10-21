<div class="col-md-4 col-sm-6">
    <a href="{client_url}login/">
        <div class="card card-dark" style="background:#45ba74">
				<div class="card-body skew-shadow text-white">
					<i class="fa fa-cogs fa-3x"></i>
					<h4>My Account</h4>
					<p>Have an account with us? Log in here to manage your account.</p>
				</div>
        </div>
    </a>
</div>
<!--div class="col-md-4 col-sm-6 portal-box">
    <a href="{client_url}login/">
        <div class="well">
            <i class="fa fa-cogs fa-4x"></i>
            <h4>My Account</h4>
            <p>Have an account with us? Log in here to manage your account.</p>
        </div>
    </a>
</div-->
{% if plugins.support_manager.enabled %}<div class="col-md-4 col-sm-6 portal-box">
    <a href="{client_url}plugin/support_manager/client_tickets/add/">
        <div class="well">
            <i class="fa fa-ticket fa-4x"></i>
            <h4>Support</h4>
            <p>Looking for help? You can open a trouble ticket here.</p>
        </div>
    </a>
</div>
	<div class="col-md-4 col-sm-6 portal-box">
    <a href="{client_url}plugin/support_manager/knowledgebase/">
        <div class="well">
            <i class="fa fa-info fa-4x"></i>
            <h4>Knowledge Base</h4>
            <p>Have a question? Search the knowledge base for an answer.</p>
        </div>
    </a>
</div>{% endif %}
{% if plugins.order.enabled %}<div class="col-md-4 col-sm-6 portal-box">
    <a href="{blesta_url}order/">
        <div class="well">
            <i class="fa fa-shopping-cart fa-4x"></i>
            <h4>Order</h4>
            <p>Visit the order form to sign up and purchase new products and services.</p>
        </div>
    </a>
</div>{% endif %}
{% if plugins.download_manager.enabled %}<div class="col-md-4 col-sm-6 portal-box">
    <a href="{client_url}plugin/download_manager/">
        <div class="well">
            <i class="fa fa-download fa-4x"></i>
            <h4>Download</h4>
            <p>You may need to be logged in to access certain downloads here.</p>
        </div>
    </a>
</div>{% endif %}


	<div class="col-md-4">
		<div class="card bg-gradient-success" style="background:#45ba74">
			<div class="card-body skew-shadow">card-body skew-shadow</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="card card-dark bg-gradient-succes" style="background:#45ba74">
			<div class="card-body skew-shadow">card-body skew-shadow</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="card card-dark bg-gradient-success" style="background:#45ba74">
			<div class="card-body bubble-shadow">card-body bubble-shadow</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card card-dark bg-gradient-succes" style="background:#3bc472">
			<div class="card-body curves-shadow">card-body curves-shadow</div>
		</div>
	</div>
