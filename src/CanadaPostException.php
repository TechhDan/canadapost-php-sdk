<?php

namespace TechDesign\CanadaPost;

use Exception;

class CanadaPostException extends Exception
{
	/**
	 * AAA Authentication Failure
	 * - The API key for the request is invalid. Please double check your inputs.
	 */
	const E002 = 1;
}
