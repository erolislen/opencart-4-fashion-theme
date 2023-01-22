<?php
namespace Opencart\Catalog\Controller\Common;
class Maintenance extends \Opencart\System\Engine\Controller {
	public function index(): void {
		$this->load->language('common/maintenance');

		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->request->server['SERVER_PROTOCOL'] == 'HTTP/1.1') {
			$this->response->addHeader('HTTP/1.1 503 Service Unavailable');
		} else {
			$this->response->addHeader('HTTP/1.0 503 Service Unavailable');
		}

		$this->response->addHeader('Retry-After: 3600');

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_maintenance'),
			'href' => $this->url->link('common/maintenance', 'language=' . $this->config->get('config_language'))
		];

		$data['message'] = $this->language->get('text_message');
		$data['maintenance']  = html_entity_decode($this->config->get('config_maintenance_html'), ENT_QUOTES, "UTF-8");


		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('common/maintenance', $data));
	}
}
