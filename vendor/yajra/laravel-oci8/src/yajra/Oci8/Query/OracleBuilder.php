<?php namespace yajra\Oci8\Query;

use Illuminate\Database\Query\Builder;

class OracleBuilder extends Builder {

	/**
	 * Insert a new record and get the value of the primary key.
	 *
	 * @param  array   $values
	 * @param  array   $binaries
	 * @param  string   $sequence
	 * @return int
	 */
	public function insertLob(array $values, array $binaries, $sequence = null)
	{
		$sql = $this->grammar->compileInsertLob($this, $values, $binaries, $sequence);

		$values = $this->cleanBindings($values);
		$binaries = $this->cleanBindings($binaries);

		return $this->processor->saveLob($this, $sql, $values, $binaries);
	}

	/**
	 * Update a new record with blob field.
	 *
	 * @param  array   $values
	 * @param  array   $binaries
	 * @param  string   $sequence
	 * @return boolean
	 */
	public function updateLob(array $values, array $binaries, $sequence = null)
	{
		$bindings = array_values(array_merge($values, $this->getBindings()));

		$sql = $this->grammar->compileUpdateLob($this, $values, $binaries, $sequence);

		$values = $this->cleanBindings($bindings);
		$binaries = $this->cleanBindings($binaries);

		return $this->processor->saveLob($this, $sql, $values, $binaries);
	}

	/**
	 * Pluck a single column's value from the first result of a query.
	 *
	 * @param  string  $column
	 * @return mixed
	 */
	public function pluck($column)
	{
		$result = (array) $this->first(array($column));
		return count($result) > 0 ? $result[$column] : null;
	}

	/**
     * Add a "where in" clause to the query.
     * Split one WHERE IN clause into multiple clauses each
     * with up to 1000 expressions to avoid ORA-01795
     *
     * @param  mixed  $column
     * @param  array  $values
     * @param  string  $boolean
     * @param  bool  $not
     * @return mixed
     */
    public function whereIn($column, $values, $boolean = 'and', $not = false)
    {
        $type = $not ? 'NotIn' : 'In';

        if (count($values) > 1000)
        {
            $chunks = array_chunk($values,1000);
            return $this->where(function($query) use ($column,$chunks,$type)
            {
                $firstIteration=true;
                foreach ($chunks as $ch)
                {
                    $sqlClause = $firstIteration ? 'where'.$type : 'orWhere'.$type;
                    $query->$sqlClause($column,$ch);
                    $firstIteration=false;
                }

            },null,null,$boolean);
        }
        else
        {
            return parent::whereIn($column, $values, $boolean, $not);
        }
    }

}
