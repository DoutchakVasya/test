<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Http\Requests\FormZoro;

class BaseController extends Controller
{
	/**
	 * tokenUser - User's token from ZohoCRM
	 * @var mixed
	 */
	private $tokenUser;


	/**
	 * BaseController constructor.
	 */
	public function __construct()
	{
		$this->tokenUser = env('ZOHO_USER_TOKEN');
	}

	/**
	 * Create new deal
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return view('home');
	}


	/**
	 * Store a new deal with Zoho CRM
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function storePotential(FormZoro $request)
	{

		$date = Carbon::parse($request->date)->format('m/d/Y');

		if (isset($this->tokenUser) && !empty($this->tokenUser)) {

			//Create new Potential [Deal]

			$client = new Client();

			$xml = "<Potentials>
						<row no=\"1\">
							<FL val=\"Potential Name\">$request->name</FL>
							<FL val=\"Closing Date\">$date</FL>
							<FL val=\"Probability\">$request->status</FL>
						</row>
					</Potentials>";


			$response = $client->request('POST', 'https://crm.zoho.eu/crm/private/json/Potentials/insertRecords', [
				'query' => [
					'authtoken' => $this->tokenUser,
					'scope' => 'crmapi',
					'xmlData' => $xml,
					'duplicateCheck' => 1
					//Set value as "1" to check the duplicate records and throw an error response
					// or "2" to check the duplicate records, if exists, update the same.
				]
			]);

			$deal = json_decode($response->getBody(), true);
			$dealId = $deal['response']['result']['recorddetail']['FL']['0']['content'];

			try {

				return $this->storeCall($dealId);

			} catch (Exception $e) {

				return $e->getMessage();

			}


		}
	}

	/**
	 * Store a new task according to deal
	 *
	 * @param int $dealId
	 * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function storeCall(int $dealId)
	{
		if (isset($this->tokenUser) && !empty($this->tokenUser)) {

			//Create new Call

			$client = new Client();

			$xml = "<Task>
						<row no=\"1\">
							<FL val=\"Subject\">Звонок</FL>
							<FL val=\"What Id\">$dealId</FL>
						</row>
					</Task>";


			$response = $client->request('POST', 'https://crm.zoho.eu/crm/private/json/Tasks/insertRecords', [
				'query' => [
					'authtoken' => $this->tokenUser,
					'scope' => 'crmapi',
					'xmlData' => $xml,
					'duplicateCheck' => 1
					//Set value as "1" to check the duplicate records and throw an error response
					// or "2" to check the duplicate records, if exists, update the same.
				]
			]);

			$task = json_decode($response->getBody(), true);
			$taskId = $task['response']['result']['recorddetail']['FL']['0']['content'];

			if (!empty($taskId)) {

				return view('tasks', [
					'taskId' => $taskId,
					'dealId' => $dealId
				]);

			} else {

				return view('tasks')->withErrors();

			}


		}
	}
}
