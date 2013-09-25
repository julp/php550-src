/*
   +----------------------------------------------------------------------+
   | PHP Version 5                                                        |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Authors: Gustavo Lopes <cataphract@php.net>                          |
   +----------------------------------------------------------------------+
 */

#include "codepointiterator_internal.h"

extern "C" {
#define USE_BREAKITERATOR_POINTER 1
#include "breakiterator_class.h"
}

using PHP::CodePointBreakIterator;

static inline CodePointBreakIterator *fetch_cpbi(BreakIterator_object *bio) {
	return (CodePointBreakIterator*)bio->biter;
}

U_CFUNC PHP_FUNCTION(cpbi_get_last_code_point)
{
	BREAKITER_METHOD_INIT_VARS;
	object = getThis();

	if (zend_parse_parameters_none() == FAILURE) {
		intl_error_set(NULL, U_ILLEGAL_ARGUMENT_ERROR,
			"cpbi_get_last_code_point: bad arguments", 0, TSRMLS_C);
		RETURN_FALSE;
	}

	BREAKITER_METHOD_FETCH_OBJECT;

	RETURN_LONG(fetch_cpbi(bio)->getLastCodePoint());
}